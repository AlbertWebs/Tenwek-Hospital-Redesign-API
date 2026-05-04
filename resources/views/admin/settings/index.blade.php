@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <x-admin.breadcrumb :items="['Settings' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Settings</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Site name, contact, social links, SEO defaults, and homepage hero.</p>
    </div>

    @if ($settingsTableMissing ?? false)
        <div class="mb-6 max-w-3xl rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-950 dark:border-amber-900 dark:bg-amber-950/40 dark:text-amber-100">
            The <code class="rounded bg-amber-100/80 px-1 dark:bg-amber-900/80">settings</code> table was not found. Run <code class="rounded bg-amber-100/80 px-1 dark:bg-amber-900/80">php artisan migrate</code> (and <code class="rounded bg-amber-100/80 px-1 dark:bg-amber-900/80">php artisan db:seed --class=SettingSeeder</code>) to enable saving.
        </div>
    @endif

    @if (session('status'))
        <div class="mb-6 max-w-3xl rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900 dark:border-teal-800 dark:bg-teal-950/40 dark:text-teal-100">
            {{ session('status') }}
        </div>
    @endif

    @error('settings')
        <div class="mb-6 max-w-3xl rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950/40 dark:text-red-100">
            {{ $message }}
        </div>
    @enderror

    <div class="space-y-8 max-w-3xl">
        @unless($settingsTableMissing ?? false)
            <form method="post" action="{{ route('admin.settings.update') }}" class="space-y-8" x-data="{ heroType: @js(old('hero_type', $heroType)), managedCarouselId: @js((string) (int) old('hero_managed_carousel_id', $heroManagedCarouselId ?? 0)) }">
                @csrf

                @php $groupOrder = ['general', 'contact', 'social', 'seo']; @endphp
                @foreach($groupOrder as $groupId)
                    @continue(empty($settingsGrouped[$groupId]))
                    <x-admin.card class="scroll-mt-24">
                        <h2 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $groupLabels[$groupId] ?? ucfirst($groupId) }}</h2>
                        <p class="mb-6 text-sm text-slate-500 dark:text-slate-400">These values are used across the public site header, footer, and default meta tags.</p>
                        <div class="space-y-5">
                            @foreach($settingsGrouped[$groupId] as $field)
                                <div class="space-y-1.5">
                                    <label for="setting_{{ $field['key'] }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ $field['label'] }}</label>
                                    @if(($field['key'] ?? '') === 'meta_description_default')
                                        <textarea name="{{ $field['key'] }}" id="setting_{{ $field['key'] }}" rows="4"
                                                  class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">{{ $field['value'] }}</textarea>
                                    @else
                                        <input type="text" name="{{ $field['key'] }}" id="setting_{{ $field['key'] }}"
                                               value="{{ $field['value'] }}"
                                               class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                                    @endif
                                    @if(!empty($field['hint']))
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $field['hint'] }}</p>
                                    @endif
                                    @error($field['key'])
                                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </x-admin.card>
                @endforeach

                <x-admin.card class="scroll-mt-24">
                    <h2 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">Homepage hero</h2>
                    <p class="mb-6 text-sm text-slate-500 dark:text-slate-400">Background video (YouTube or Vimeo embed) or full-width image carousel.</p>

                    <div class="space-y-6">
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
                                   value="{{ $heroVideoEmbedUrl }}"
                                   class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm"
                                   placeholder="https://www.youtube.com/embed/VIDEO_ID?...">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Full <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">iframe src</code> from YouTube (<span class="whitespace-nowrap">/embed/</span>) or Vimeo (<span class="whitespace-nowrap">player.vimeo.com/video/</span>). HTTPS only.</p>
                            @error('hero_video_embed_url')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="heroType === 'carousel'" class="space-y-6">
                            <div class="space-y-2">
                                <label for="hero_managed_carousel_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image source</label>
                                <select name="hero_managed_carousel_id" id="hero_managed_carousel_id" x-model="managedCarouselId"
                                        class="block w-full max-w-lg rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                                    <option value="0">Manual JSON (below)</option>
                                    @foreach($carouselsForHero ?? [] as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->slides_count }} {{ Str::plural('slide', $c->slides_count) }})</option>
                                    @endforeach
                                </select>
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Upload images under
                                    <a href="{{ route('admin.carousels.index') }}" class="font-medium text-teal-600 hover:text-teal-700 dark:text-teal-400">Carousels</a>.
                                    When a saved carousel is selected, the JSON field is ignored.
                                </p>
                                @error('hero_managed_carousel_id')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="managedCarouselId === '0'" class="space-y-2">
                                <label for="hero_carousel_slides_json" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Carousel slides (JSON)</label>
                                <textarea name="hero_carousel_slides_json" id="hero_carousel_slides_json" rows="14"
                                          class="block w-full rounded-xl border-slate-300 bg-white font-mono text-xs shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 sm:text-sm">{{ $heroCarouselSlidesJson }}</textarea>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Array of <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">{"image":"https://...","alt":"..."}</code> objects. Required when “Manual JSON” is selected.</p>
                                @error('hero_carousel_slides_json')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </x-admin.card>

                <div class="flex flex-wrap items-center gap-3">
                    <x-admin.button type="submit" variant="primary" size="md">Save all settings</x-admin.button>
                    <span class="text-sm text-slate-500 dark:text-slate-400">General, contact, social, SEO, and hero are saved together.</span>
                </div>
            </form>
        @endunless

        <x-admin.card id="profile" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Profile</h2>
            <p class="text-slate-500 dark:text-slate-400">Your admin account details.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200">{{ auth()->user()->email ?? '—' }}</span>
            </div>
            <div class="mt-6 flex">
                <x-admin.button type="button" variant="outline" size="sm">Edit profile</x-admin.button>
            </div>
        </x-admin.card>

        <x-admin.card id="backup" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Backup</h2>
            <p class="text-slate-500 dark:text-slate-400">Export or backup site data. Wire these actions to Artisan commands or jobs when ready.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <x-admin.button type="button" variant="outline" size="sm">Export database</x-admin.button>
                <x-admin.button type="button" variant="outline" size="sm">Backup media</x-admin.button>
            </div>
        </x-admin.card>
    </div>
@endsection
