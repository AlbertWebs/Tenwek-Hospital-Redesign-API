<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\PublicPagesSync;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $staticPages = config('public-pages.pages', []);
        $dbPages = Page::orderBy('order')->orderBy('title')->get();
        $dbByPath = $dbPages->keyBy('slug');

        $all = collect();
        foreach ($staticPages as $item) {
            $path = $item['path'];
            $lookupSlug = $path === '' ? 'home' : $path;
            $pageType = $item['type'] ?? 'managed';
            if ($dbByPath->has($lookupSlug)) {
                $page = $dbByPath->get($lookupSlug);
                $all->push((object)[
                    'type' => $page->page_type ?? $pageType,
                    'title' => $page->title,
                    'path' => $path,
                    'slug' => $page->slug,
                    'status' => $page->status,
                    'updated_at' => $page->updated_at,
                    'page' => $page,
                    'route' => $item['route'] ?? null,
                    'group' => $item['group'] ?? null,
                    'admin_route' => $item['admin_route'] ?? $page->getListingAdminRoute(),
                    'admin_label' => $item['admin_label'] ?? $page->getListingAdminLabel(),
                ]);
            } else {
                $all->push((object)[
                    'type' => 'site',
                    'title' => $item['title'],
                    'path' => $path,
                    'slug' => $lookupSlug,
                    'status' => 'published',
                    'updated_at' => null,
                    'page' => null,
                    'route' => $item['route'] ?? null,
                    'group' => $item['group'] ?? null,
                    'admin_route' => $item['admin_route'] ?? null,
                    'admin_label' => $item['admin_label'] ?? null,
                ]);
            }
        }
        foreach ($dbPages as $page) {
            if ($all->where('slug', $page->slug)->isEmpty()) {
                $all->push((object)[
                    'type' => $page->page_type ?? 'managed',
                    'title' => $page->title,
                    'path' => $page->slug,
                    'slug' => $page->slug,
                    'status' => $page->status,
                    'updated_at' => $page->updated_at,
                    'page' => $page,
                    'route' => null,
                    'group' => 'Custom',
                    'admin_route' => $page->getListingAdminRoute(),
                    'admin_label' => $page->getListingAdminLabel(),
                ]);
            }
        }
        $pages = $all->sortBy('title')->values();
        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create', ['page' => new Page]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'template' => 'nullable|string|max:64',
            'page_type' => 'nullable|string|in:managed,listing',
            'listing_type' => 'nullable|string|max:64',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'intro' => 'nullable|string|max:65535',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['page_type'] = $validated['page_type'] ?? 'managed';
        $validated['listing_type'] = $validated['listing_type'] ?? null;
        $page = Page::create($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page created. Add sections below.');
    }

    public function edit(Page $page): View
    {
        $page->load('sections');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'template' => 'nullable|string|max:64',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'intro' => 'nullable|string|max:65535',
        ]);

        $page->update($validated);

        return back()->with('success', 'Page updated.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted.');
    }

    /**
     * Sync Page records from config so every public page can be edited individually.
     */
    public function sync(Request $request): RedirectResponse
    {
        $count = PublicPagesSync::sync();
        return redirect()->route('admin.pages.index')
            ->with('success', "Synced {$count} public pages. You can now edit each one individually.");
    }

    public function storeSection(Request $request, Page $page): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|in:hero,content,image,cta',
            'name' => 'nullable|string|max:255',
        ]);
        $order = $page->sections()->max('order') + 1;
        $section = $page->sections()->create([
            'type' => $validated['type'],
            'name' => $validated['name'] ?? ucfirst($validated['type']),
            'order' => $order,
            'content' => static::defaultContentForType($validated['type']),
            'settings' => [],
        ]);
        return response()->json(['id' => $section->id, 'type' => $section->type, 'name' => $section->name, 'order' => $section->order]);
    }

    public function updateSection(Request $request, Page $page, PageSection $section): JsonResponse|RedirectResponse
    {
        if ($section->page_id !== $page->id) {
            abort(404);
        }
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'content' => 'nullable|array',
            'content.*' => 'nullable',
            'settings' => 'nullable|array',
        ]);
        if (array_key_exists('content', $validated)) {
            $section->content = array_merge($section->content ?? [], $validated['content']);
        }
        if (array_key_exists('settings', $validated)) {
            $section->settings = array_merge($section->settings ?? [], $validated['settings']);
        }
        if (array_key_exists('name', $validated)) {
            $section->name = $validated['name'];
        }
        $section->save();
        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Section updated.');
    }

    public function destroySection(Page $page, PageSection $section): JsonResponse|RedirectResponse
    {
        if ($section->page_id !== $page->id) {
            abort(404);
        }
        $section->delete();
        if (request()->wantsJson()) {
            return response()->json(['ok' => true]);
        }
        return back()->with('success', 'Section removed.');
    }

    public function reorderSections(Request $request, Page $page): JsonResponse
    {
        $order = $request->validate(['order' => 'required|array', 'order.*' => 'integer'])['order'];
        foreach ($order as $i => $id) {
            $page->sections()->where('id', $id)->update(['order' => $i]);
        }
        return response()->json(['ok' => true]);
    }

    public function moveSection(Page $page, PageSection $section, string $direction): RedirectResponse
    {
        if ($section->page_id !== $page->id) {
            abort(404);
        }
        $sections = $page->sections()->orderBy('order')->get();
        $index = $sections->search(fn ($s) => $s->id === $section->id);
        if ($index === false) {
            return back();
        }
        if ($direction === 'up' && $index > 0) {
            $prev = $sections[$index - 1];
            $sectionOrder = $section->order;
            $prevOrder = $prev->order;
            $section->update(['order' => $prevOrder]);
            $prev->update(['order' => $sectionOrder]);
        } elseif ($direction === 'down' && $index < $sections->count() - 1) {
            $next = $sections[$index + 1];
            $sectionOrder = $section->order;
            $nextOrder = $next->order;
            $section->update(['order' => $nextOrder]);
            $next->update(['order' => $sectionOrder]);
        }
        return back()->with('success', 'Section reordered.');
    }

    protected static function defaultContentForType(string $type): array
    {
        return match ($type) {
            'hero' => ['heading' => '', 'subheading' => '', 'image' => '', 'cta_text' => '', 'cta_url' => ''],
            'content' => ['html' => ''],
            'image' => ['image_url' => '', 'caption' => '', 'layout' => 'full'],
            'cta' => ['title' => '', 'text' => '', 'button_label' => '', 'button_url' => ''],
            default => [],
        };
    }
}
