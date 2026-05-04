@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <x-admin.breadcrumb :items="['Settings' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Settings</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Site-wide settings, profile, backup, and SEO.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 max-w-2xl rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900 dark:border-teal-800 dark:bg-teal-950/40 dark:text-teal-100">
            {{ session('status') }}
        </div>
    @endif

    <div class="space-y-8 max-w-2xl">
        <x-admin.card class="scroll-mt-24">
            <h2 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">Homepage hero</h2>
            <p class="mb-6 text-sm text-slate-500 dark:text-slate-400">Choose a background video (YouTube or Vimeo embed) or an image carousel for the home page hero.</p>

            <form method="post" action="{{ route('admin.settings.update') }}" class="space-y-6" x-data="{ heroType: @js(old('hero_type', $heroType)) }">
                @csrf
                <fieldset>
                    <legend class="mb-3 text-sm font-medium text-slate-700 dark:text-slate-300">Hero type</legend>
                    <div class="flex flex-wrap gap-4">
                        <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                            <input type="radio" name="hero_type" value="video" class="rounded-full border-slate-300 text-teal-600 focus:ring-teal-500" x-model="heroType">
                            Video
                        </label>
                        <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                            <input type="radio" name="hero_type" value="carousel" class="rounded-full border-slate-300 text-teal-600 focus:ring-teal-500" x-model="heroType">
                            Carousel
                        </label>
                    </div>
                    @error('hero_type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div x-show="heroType === 'video'" class="space-y-2">
                    <label for="hero_video_embed_url" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Embed URL</label>
                    <input type="url" name="hero_video_embed_url" id="hero_video_embed_url"
                           value="{{ old('hero_video_embed_url', $heroVideoEmbedUrl) }}"
                           class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm"
                           placeholder="https://www.youtube.com/embed/VIDEO_ID?...">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Paste the full <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">iframe src</code> from YouTube embed (<span class="whitespace-nowrap">/embed/</span>) or Vimeo (<span class="whitespace-nowrap">player.vimeo.com/video/</span>). HTTPS only.</p>
                    @error('hero_video_embed_url')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="heroType === 'carousel'" class="space-y-2">
                    <label for="hero_carousel_slides_json" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Carousel slides (JSON)</label>
                    <textarea name="hero_carousel_slides_json" id="hero_carousel_slides_json" rows="14"
                              class="block w-full rounded-xl border-slate-300 bg-white font-mono text-xs shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 sm:text-sm">{{ old('hero_carousel_slides_json', $heroCarouselSlidesJson) }}</textarea>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Array of objects with <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">image</code> (https URL) and optional <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">alt</code>. At least one slide required when carousel is selected.</p>
                    @error('hero_carousel_slides_json')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <x-admin.button type="submit" variant="primary" size="sm">Save hero settings</x-admin.button>
                </div>
            </form>
        </x-admin.card>

        <x-admin.card id="profile" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Profile</h2>
            <p class="text-slate-500">Your admin account details. Name and email can be updated here (wire to user profile form).</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700">{{ auth()->user()->email ?? '—' }}</span>
            </div>
            <div class="mt-6 flex">
                <x-admin.button type="button" variant="outline" size="sm">Edit profile</x-admin.button>
            </div>
        </x-admin.card>

        <x-admin.card>
            <h2 class="mb-4 text-lg font-semibold text-slate-900">General</h2>
            <p class="text-slate-500">Site name, tagline, and default SEO. Form can be wired to Settings model.</p>
            <div class="mt-6 flex">
                <x-admin.button type="button" variant="primary">Save settings</x-admin.button>
            </div>
        </x-admin.card>

        <x-admin.card id="backup" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Backup</h2>
            <p class="text-slate-500">Export or backup site data. Database and media backups can be run from here (wire to backup job/command).</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <x-admin.button type="button" variant="outline" size="sm">Export database</x-admin.button>
                <x-admin.button type="button" variant="outline" size="sm">Backup media</x-admin.button>
            </div>
        </x-admin.card>
    </div>
@endsection
