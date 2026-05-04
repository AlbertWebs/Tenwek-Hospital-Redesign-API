<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $defaultSlides = [
            ['image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Tenwek Hospital care environment'],
            ['image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Clinical excellence'],
            ['image' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Hospital community'],
        ];

        $defaultVideo = 'https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1';

        if (! Schema::hasTable('settings')) {
            return view('home', [
                'heroType' => 'video',
                'heroVideoEmbedUrl' => $defaultVideo,
                'heroCarouselSlides' => $defaultSlides,
            ]);
        }

        $heroType = Setting::get('hero_type', 'video') === 'carousel' ? 'carousel' : 'video';

        $slides = Setting::get('hero_carousel_slides', $defaultSlides);
        if (! is_array($slides)) {
            $slides = $defaultSlides;
        }

        if ($heroType === 'carousel' && Schema::hasTable('carousels')) {
            $managedId = (int) Setting::get('hero_managed_carousel_id', 0);
            if ($managedId > 0) {
                $carousel = Carousel::query()
                    ->with(['slides' => fn ($q) => $q->orderBy('sort_order')->orderBy('id')])
                    ->find($managedId);
                if ($carousel && $carousel->slides->isNotEmpty()) {
                    $slides = $carousel->slides->map(fn ($s) => [
                        'image' => $s->image_url,
                        'alt' => (string) ($s->alt_text ?? ''),
                    ])->all();
                }
            }
        }

        return view('home', [
            'heroType' => $heroType,
            'heroVideoEmbedUrl' => Setting::get('hero_video_embed_url', $defaultVideo),
            'heroCarouselSlides' => $slides,
        ]);
    }
}
