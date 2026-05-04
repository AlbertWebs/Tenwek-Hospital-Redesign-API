<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\CarouselSlide;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CarouselController extends Controller
{
    public function index(): View
    {
        $carousels = Carousel::withCount('slides')->orderBy('name')->get();

        return view('admin.carousels.index', compact('carousels'));
    }

    public function create(): View
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:160',
            'slug' => 'nullable|string|max:160',
            'description' => 'nullable|string|max:2000',
        ]);

        $slugInput = trim((string) ($validated['slug'] ?? ''));
        $slug = $slugInput !== ''
            ? Str::slug($slugInput)
            : Str::slug($validated['name']);
        $slug = $this->uniqueSlug($slug);

        Carousel::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.carousels.index')->with('status', 'Carousel created. Add slides from Edit.');
    }

    public function edit(Carousel $carousel): View
    {
        $carousel->load(['slides' => fn ($q) => $q->orderBy('sort_order')->orderBy('id')]);

        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:160',
            'slug' => 'required|string|max:160|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'description' => 'nullable|string|max:2000',
        ]);

        $slug = Str::slug($validated['slug']);
        if ($slug !== $carousel->slug) {
            $slug = $this->uniqueSlug($slug, $carousel->id);
        }

        $carousel->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.carousels.edit', $carousel)->with('status', 'Carousel updated.');
    }

    public function destroy(Carousel $carousel): RedirectResponse
    {
        if (Schema::hasTable('settings')) {
            $managed = (int) Setting::get('hero_managed_carousel_id', 0);
            if ($managed === (int) $carousel->id) {
                Setting::put('hero_managed_carousel_id', 0, 'integer', 'hero');
            }
        }

        foreach ($carousel->slides as $slide) {
            $slide->delete();
        }
        $carousel->delete();

        return redirect()->route('admin.carousels.index')->with('status', 'Carousel deleted.');
    }

    public function storeSlide(Request $request, Carousel $carousel): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,gif|max:10240',
            'alt_text' => 'nullable|string|max:500',
        ]);

        $path = $request->file('image')->store('carousels/'.$carousel->id, 'public');
        $maxOrder = (int) $carousel->slides()->max('sort_order');

        CarouselSlide::create([
            'carousel_id' => $carousel->id,
            'sort_order' => $maxOrder + 1,
            'image_path' => $path,
            'disk' => 'public',
            'alt_text' => $validated['alt_text'] ?? null,
        ]);

        return redirect()->route('admin.carousels.edit', $carousel)->with('status', 'Slide added.');
    }

    public function updateSlide(Request $request, Carousel $carousel, CarouselSlide $slide): RedirectResponse
    {
        $this->authorizeSlide($carousel, $slide);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,webp,gif|max:10240',
            'alt_text' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            $slide->deleteImageFile();
            $slide->image_path = $request->file('image')->store('carousels/'.$carousel->id, 'public');
            $slide->disk = 'public';
        }

        $slide->alt_text = $validated['alt_text'] ?? null;
        $slide->save();

        return redirect()->route('admin.carousels.edit', $carousel)->with('status', 'Slide updated.');
    }

    public function destroySlide(Carousel $carousel, CarouselSlide $slide): RedirectResponse
    {
        $this->authorizeSlide($carousel, $slide);
        $slide->delete();

        return redirect()->route('admin.carousels.edit', $carousel)->with('status', 'Slide removed.');
    }

    private function authorizeSlide(Carousel $carousel, CarouselSlide $slide): void
    {
        abort_unless((int) $slide->carousel_id === (int) $carousel->id, 404);
    }

    private function uniqueSlug(string $slug, ?int $ignoreCarouselId = null): string
    {
        $base = $slug !== '' ? $slug : 'carousel';
        $candidate = $base;
        $n = 2;
        while (Carousel::where('slug', $candidate)
            ->when($ignoreCarouselId, fn ($q) => $q->where('id', '!=', $ignoreCarouselId))
            ->exists()) {
            $candidate = $base.'-'.$n;
            $n++;
        }

        return $candidate;
    }
}
