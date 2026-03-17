<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $location = $request->get('menu', 'header');
        $menus = Menu::orderByRaw("CASE WHEN location = 'header' THEN 0 WHEN location = 'footer' THEN 1 ELSE 2 END")->get();
        $currentMenu = $menus->firstWhere('location', $location) ?? $menus->first();
        if (!$currentMenu) {
            $currentMenu = Menu::firstOrCreate(
                ['key' => 'header'],
                ['name' => 'Header Menu', 'location' => 'header', 'description' => 'Main navigation']
            );
            $footer = Menu::firstOrCreate(
                ['key' => 'footer'],
                ['name' => 'Footer Menu', 'location' => 'footer', 'description' => 'Footer links']
            );
            $menus = Menu::orderByRaw("CASE WHEN location = 'header' THEN 0 WHEN location = 'footer' THEN 1 ELSE 2 END")->get();
            $currentMenu = $menus->firstWhere('location', $location) ?? $menus->first();
        }
        $items = $currentMenu->allItems()->with('page')->get();
        $tree = $this->buildTree($items);
        $pages = Page::orderBy('title')->get(['id', 'title', 'slug']);
        $editItem = null;
        if ($request->has('edit')) {
            $editItem = MenuItem::where('menu_id', $currentMenu->id)->with('page')->find($request->get('edit'));
        }
        return view('admin.menus.index', compact('menus', 'currentMenu', 'tree', 'pages', 'editItem'));
    }

    public function storeItem(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:2048',
            'route' => 'nullable|string|max:64',
            'page_id' => 'nullable|exists:pages,id',
            'open_in_new_tab' => 'boolean',
            'icon' => 'nullable|string|max:64',
        ]);
        $validated['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $maxOrder = MenuItem::where('menu_id', $validated['menu_id'])
            ->where('parent_id', $validated['parent_id'] ?? null)
            ->max('order');
        $validated['order'] = $maxOrder + 1;
        $validated['is_visible'] = true;
        $item = MenuItem::create($validated);
        if ($request->wantsJson()) {
            return response()->json(['id' => $item->id, 'label' => $item->label, 'order' => $item->order]);
        }
        return back()->with('success', 'Menu item added.');
    }

    public function updateItem(Request $request, MenuItem $item): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'sometimes|required|string|max:255',
            'url' => 'nullable|string|max:2048',
            'route' => 'nullable|string|max:64',
            'page_id' => 'nullable|exists:pages,id',
            'open_in_new_tab' => 'boolean',
            'icon' => 'nullable|string|max:64',
        ]);
        if (array_key_exists('open_in_new_tab', $validated)) {
            $validated['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        }
        $item->update($validated);
        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Menu item updated.');
    }

    public function destroyItem(MenuItem $item): JsonResponse|RedirectResponse
    {
        $menuId = $item->menu_id;
        $item->children()->update(['parent_id' => $item->parent_id]);
        $item->delete();
        $this->reorderSiblings($menuId, $item->parent_id);
        if (request()->wantsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Menu item removed.');
    }

    public function duplicateItem(MenuItem $item): RedirectResponse
    {
        $this->duplicateRecursive($item);
        return back()->with('success', 'Menu item duplicated.');
    }

    public function reorder(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'order' => 'required|array',
            'order.*.id' => 'required|exists:menu_items,id',
            'order.*.children' => 'nullable|array',
            'order.*.children.*.id' => 'required|exists:menu_items,id',
            'order.*.children.*.children' => 'nullable|array',
        ]);
        $this->applyOrder($validated['menu_id'], $validated['order'], null);
        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Order saved.');
    }

    /** Build nested tree from flat list. */
    protected function buildTree($items, ?int $parentId = null): array
    {
        $branch = [];
        foreach ($items->where('parent_id', $parentId) as $item) {
            $node = $item->toArray();
            $node['children'] = $this->buildTree($items, (int) $item->id);
            $node['page'] = $item->relationLoaded('page') ? $item->page : null;
            $branch[] = $node;
        }
        return $branch;
    }

    protected function applyOrder(int $menuId, array $order, ?int $parentId, int $index = 0): void
    {
        foreach ($order as $entry) {
            MenuItem::where('id', $entry['id'])->where('menu_id', $menuId)->update([
                'parent_id' => $parentId,
                'order' => $index,
            ]);
            $index++;
            if (!empty($entry['children'])) {
                $this->applyOrder($menuId, $entry['children'], (int) $entry['id'], 0);
            }
        }
    }

    protected function reorderSiblings(int $menuId, ?int $parentId): void
    {
        $siblings = MenuItem::where('menu_id', $menuId)->where('parent_id', $parentId)->orderBy('order')->get();
        foreach ($siblings as $i => $s) {
            $s->update(['order' => $i]);
        }
    }

    protected function duplicateRecursive(MenuItem $item): MenuItem
    {
        $new = $item->replicate();
        $new->label = $item->label . ' (copy)';
        $maxOrder = MenuItem::where('menu_id', $item->menu_id)->where('parent_id', $item->parent_id)->max('order');
        $new->order = $maxOrder + 1;
        $new->save();
        foreach ($item->children as $child) {
            $dup = $this->duplicateRecursive($child);
            $dup->update(['parent_id' => $new->id]);
        }
        return $new;
    }
}
