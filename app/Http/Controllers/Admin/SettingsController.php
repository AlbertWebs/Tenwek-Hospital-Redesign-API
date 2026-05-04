<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $defaultSlides = [
            ['image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Tenwek Hospital care environment'],
            ['image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Clinical excellence'],
            ['image' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Hospital community'],
        ];

        $slides = Setting::get('hero_carousel_slides', $defaultSlides);
        if (! is_array($slides)) {
            $slides = $defaultSlides;
        }

        return view('admin.settings.index', [
            'heroType' => Setting::get('hero_type', 'video') === 'carousel' ? 'carousel' : 'video',
            'heroVideoEmbedUrl' => Setting::get(
                'hero_video_embed_url',
                'https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1'
            ),
            'heroCarouselSlidesJson' => json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_type' => 'required|string|in:video,carousel',
            'hero_video_embed_url' => 'required_if:hero_type,video|nullable|string|max:2048',
            'hero_carousel_slides_json' => 'required_if:hero_type,carousel|nullable|string|max:65535',
        ]);

        if ($validated['hero_type'] === 'video') {
            $videoUrl = trim((string) ($validated['hero_video_embed_url'] ?? ''));
            if (! self::isAllowedHeroVideoEmbedUrl($videoUrl)) {
                return back()->withErrors(['hero_video_embed_url' => 'Use a secure YouTube or Vimeo embed URL (https://www.youtube.com/embed/… or https://player.vimeo.com/video/…).'])->withInput();
            }
        }

        $slides = [];
        if ($validated['hero_type'] === 'carousel') {
            $raw = $validated['hero_carousel_slides_json'] ?? '';
            $decoded = json_decode($raw, true);
            if (! is_array($decoded)) {
                return back()->withErrors(['hero_carousel_slides_json' => 'Carousel slides must be valid JSON: an array of objects with "image" (URL) and optional "alt".'])->withInput();
            }
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
        }

        Setting::put('hero_type', $validated['hero_type'], 'string', 'hero');
        if ($validated['hero_type'] === 'video') {
            Setting::put('hero_video_embed_url', trim((string) ($validated['hero_video_embed_url'] ?? '')), 'string', 'hero');
        } else {
            Setting::put('hero_carousel_slides', $slides, 'json', 'hero');
        }

        return redirect()->route('admin.settings.index')->with('status', 'Homepage hero settings saved.');
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
