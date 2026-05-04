<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Setting;
use App\Support\SiteSettingDefaults;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $defaults = SiteSettingDefaults::items();
        $values = $defaults;

        if (Schema::hasTable('settings')) {
            foreach (array_keys($defaults) as $key) {
                $values[$key] = (string) Setting::get($key, $defaults[$key]);
            }
        }

        $slideDefaults = [
            ['image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Tenwek Hospital care environment'],
            ['image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Clinical excellence'],
            ['image' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Hospital community'],
        ];

        $slides = Schema::hasTable('settings')
            ? Setting::get('hero_carousel_slides', $slideDefaults)
            : $slideDefaults;
        if (! is_array($slides)) {
            $slides = $slideDefaults;
        }

        $heroType = Schema::hasTable('settings') && Setting::get('hero_type', 'video') === 'carousel'
            ? 'carousel'
            : 'video';

        $heroVideoDefault = 'https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1';
        $heroVideoEmbedUrl = Schema::hasTable('settings')
            ? (string) Setting::get('hero_video_embed_url', $heroVideoDefault)
            : $heroVideoDefault;

        $heroManagedCarouselId = Schema::hasTable('settings')
            ? (int) Setting::get('hero_managed_carousel_id', 0)
            : 0;

        $carouselsForHero = Schema::hasTable('carousels')
            ? Carousel::query()->withCount('slides')->orderBy('name')->get(['id', 'name', 'slug'])
            : collect();

        $definitions = SiteSettingDefaults::definitions();
        $grouped = [];
        foreach ($definitions as $key => $def) {
            $group = $def['group'];
            $grouped[$group][] = array_merge($def, [
                'key' => $key,
                'value' => old($key, $values[$key] ?? ''),
            ]);
        }

        return view('admin.settings.index', [
            'settingsGrouped' => $grouped,
            'groupLabels' => SiteSettingDefaults::groupLabels(),
            'settingsTableMissing' => ! Schema::hasTable('settings'),
            'heroType' => old('hero_type', $heroType),
            'heroVideoEmbedUrl' => old('hero_video_embed_url', $heroVideoEmbedUrl),
            'heroCarouselSlidesJson' => old('hero_carousel_slides_json', json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)),
            'heroManagedCarouselId' => (int) old('hero_managed_carousel_id', $heroManagedCarouselId),
            'carouselsForHero' => $carouselsForHero,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('settings')) {
            return redirect()->route('admin.settings.index')->withErrors(['settings' => 'The settings table is missing. Run migrations.']);
        }

        $rules = [];
        foreach (SiteSettingDefaults::definitions() as $key => $def) {
            $rules[$key] = $def['rules'];
        }

        $rules['hero_type'] = 'required|string|in:video,carousel';
        $rules['hero_video_embed_url'] = 'required_if:hero_type,video|nullable|string|max:2048';
        $rules['hero_carousel_slides_json'] = [
            Rule::requiredIf(function () use ($request) {
                return $request->input('hero_type') === 'carousel'
                    && (int) $request->input('hero_managed_carousel_id', 0) === 0;
            }),
            'nullable',
            'string',
            'max:65535',
        ];
        $rules['hero_managed_carousel_id'] = [
            'nullable',
            'integer',
            'min:0',
            function (string $attribute, mixed $value, \Closure $fail): void {
                $id = (int) $value;
                if ($id === 0) {
                    return;
                }
                if (! Schema::hasTable('carousels') || ! Carousel::whereKey($id)->exists()) {
                    $fail('The selected carousel is invalid.');
                }
            },
        ];

        $validated = $request->validate($rules);

        $socialKeys = ['twitter', 'facebook', 'youtube', 'instagram', 'linkedin'];
        foreach ($socialKeys as $sk) {
            $v = isset($validated[$sk]) ? trim((string) $validated[$sk]) : '';
            if ($v === '') {
                continue;
            }
            if (! filter_var($v, FILTER_VALIDATE_URL)) {
                return back()->withErrors([$sk => 'Enter a valid URL or leave this field empty.'])->withInput();
            }
            $scheme = strtolower((string) parse_url($v, PHP_URL_SCHEME));
            if (! in_array($scheme, ['http', 'https'], true)) {
                return back()->withErrors([$sk => 'Social links must use http:// or https://'])->withInput();
            }
        }

        foreach (SiteSettingDefaults::definitions() as $key => $def) {
            $raw = $validated[$key] ?? '';
            Setting::put($key, is_string($raw) ? trim($raw) : (string) $raw, 'string', $def['group']);
        }

        $managedCarouselId = (int) $request->input('hero_managed_carousel_id', 0);
        Setting::put('hero_managed_carousel_id', $managedCarouselId, 'integer', 'hero');

        if ($validated['hero_type'] === 'video') {
            $videoUrl = trim((string) ($validated['hero_video_embed_url'] ?? ''));
            if (! self::isAllowedHeroVideoEmbedUrl($videoUrl)) {
                return back()->withErrors(['hero_video_embed_url' => 'Use a secure YouTube or Vimeo embed URL (https://www.youtube.com/embed/… or https://player.vimeo.com/video/…).'])->withInput();
            }
            Setting::put('hero_type', 'video', 'string', 'hero');
            Setting::put('hero_video_embed_url', $videoUrl, 'string', 'hero');
        } else {
            Setting::put('hero_type', 'carousel', 'string', 'hero');
            if ($managedCarouselId > 0) {
                $carousel = Carousel::query()->withCount('slides')->find($managedCarouselId);
                if (! $carousel || $carousel->slides_count < 1) {
                    return back()->withErrors(['hero_managed_carousel_id' => 'Pick a carousel that has at least one slide, or choose “Manual JSON” and add slides in the JSON field.'])->withInput();
                }
            } else {
                $raw = $validated['hero_carousel_slides_json'] ?? '';
                $decoded = json_decode($raw, true);
                if (! is_array($decoded)) {
                    return back()->withErrors(['hero_carousel_slides_json' => 'Carousel slides must be valid JSON: an array of objects with "image" (URL) and optional "alt".'])->withInput();
                }
                $slides = [];
                foreach ($decoded as $row) {
                    if (! is_array($row)) {
                        continue;
                    }
                    $image = trim((string) ($row['image'] ?? ''));
                    if ($image === '') {
                        continue;
                    }
                    if (! filter_var($image, FILTER_VALIDATE_URL)) {
                        return back()->withErrors(['hero_carousel_slides_json' => 'Each slide "image" must be a valid URL.'])->withInput();
                    }
                    if (($parsed = parse_url($image)) && ($parsed['scheme'] ?? '') !== 'https') {
                        return back()->withErrors(['hero_carousel_slides_json' => 'Slide images must use https:// URLs.'])->withInput();
                    }
                    $slides[] = [
                        'image' => $image,
                        'alt' => (string) ($row['alt'] ?? ''),
                    ];
                }
                if (count($slides) < 1) {
                    return back()->withErrors(['hero_carousel_slides_json' => 'Add at least one slide with an "image" URL.'])->withInput();
                }
                Setting::put('hero_carousel_slides', $slides, 'json', 'hero');
            }
        }

        return redirect()->route('admin.settings.index')->with('status', 'Site settings saved.');
    }

    private static function isAllowedHeroVideoEmbedUrl(string $url): bool
    {
        if ($url === '' || strlen($url) > 2048) {
            return false;
        }
        $parts = parse_url($url);
        if (($parts['scheme'] ?? '') !== 'https') {
            return false;
        }
        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';

        if (in_array($host, ['www.youtube.com', 'youtube.com', 'www.youtube-nocookie.com'], true)) {
            return str_starts_with($path, '/embed/');
        }

        if ($host === 'player.vimeo.com') {
            return str_starts_with($path, '/video/');
        }

        return false;
    }
}
