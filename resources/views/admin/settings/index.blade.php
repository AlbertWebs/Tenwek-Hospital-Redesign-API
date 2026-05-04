@extends('admin.layouts.app')

@section('title', 'Settings')

@php
    $sectionIntro = [
        'general' => 'Branding and the top notification strip visitors see before the ambulance number.',
        'contact' => 'Numbers and address shown in the footer and contact areas.',
        'social' => 'Header icons only appear when a URL is saved. Use full https:// links.',
        'seo' => 'Default tags for pages that do not set their own title or description.',
    ];
    $inputBase = 'mt-2 block w-full rounded-xl border-0 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200/90 transition placeholder:text-slate-400 hover:bg-slate-50/90 focus:bg-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500 dark:bg-slate-900/70 dark:text-slate-100 dark:ring-slate-600 dark:placeholder:text-slate-500 dark:hover:bg-slate-900/90 dark:focus:bg-slate-900 dark:focus:ring-teal-400';
    $inputError = ' ring-red-400 focus:ring-red-500 dark:ring-red-500/70 dark:focus:ring-red-500';
    $labelClass = 'block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400';
    $hintClass = 'mt-2 text-xs leading-relaxed text-slate-500 dark:text-slate-400';
    $codeChip = 'rounded-md bg-slate-100 px-1.5 py-0.5 font-mono text-[0.7rem] text-slate-700 dark:bg-slate-700 dark:text-slate-200';
@endphp

@section('content')
    <x-admin.breadcrumb :items="['Settings' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Settings</h1>
        <p class="mt-1 max-w-2xl text-slate-600 dark:text-slate-400">Site name, contact, social links, SEO defaults, and homepage hero. Changes apply to the public site after you save.</p>
    </div>

    @if ($settingsTableMissing ?? false)
        <div class="mb-6 max-w-3xl rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-950 dark:border-amber-900 dark:bg-amber-950/40 dark:text-amber-100">
            The <code class="{{ $codeChip }}">settings</code> table was not found. Run <code class="{{ $codeChip }}">php artisan migrate</code> (and <code class="{{ $codeChip }}">php artisan db:seed --class=SettingSeeder</code>) to enable saving.
        </div>
    @endif

    @if (session('status'))
        <div class="mb-6 flex max-w-3xl items-start gap-3 rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900 dark:border-teal-800 dark:bg-teal-950/40 dark:text-teal-100">
            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-teal-600 text-white" aria-hidden="true">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </span>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @error('settings')
        <div class="mb-6 max-w-3xl rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950/40 dark:text-red-100">
            {{ $message }}
        </div>
    @enderror

    <div class="max-w-3xl space-y-8 pb-8">
        @unless($settingsTableMissing ?? false)
            <form method="post" action="{{ route('admin.settings.update') }}" class="space-y-8" x-data="{ heroType: @js(old('hero_type', $heroType)), managedCarouselId: @js((string) (int) old('hero_managed_carousel_id', $heroManagedCarouselId ?? 0)) }">
                @csrf

                @php $groupOrder = ['general', 'contact', 'social', 'seo']; @endphp
                @foreach($groupOrder as $groupId)
                    @continue(empty($settingsGrouped[$groupId]))
                    <x-admin.card class="scroll-mt-24 overflow-hidden" padding="false">
                        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50/90 to-white px-6 py-4 dark:border-slate-700 dark:from-slate-800/80 dark:to-slate-800/40">
                            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $groupLabels[$groupId] ?? ucfirst($groupId) }}</h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $sectionIntro[$groupId] ?? 'These values are used on the public site.' }}</p>
                        </div>
                        <div class="p-6">
                            @php
                                $useSocialGrid = $groupId === 'social';
                            @endphp
                            <div class="{{ $useSocialGrid ? 'grid gap-6 sm:grid-cols-2' : 'max-w-2xl space-y-6' }}">
                                @foreach($settingsGrouped[$groupId] as $field)
                                    @php
                                        $key = $field['key'] ?? '';
                                        $inputType = match (true) {
                                            str_ends_with($key, 'email') => 'email',
                                            in_array($key, ['twitter', 'facebook', 'youtube', 'instagram', 'linkedin'], true) => 'url',
                                            default => 'text',
                                        };
                                        $hasErr = $errors->has($key);
                                        $fieldInputClass = $inputBase . ($hasErr ? $inputError : '');
                                    @endphp
                                    <div class="min-w-0">
                                        <label for="setting_{{ $key }}" class="{{ $labelClass }}">{{ $field['label'] }}</label>
                                        @if($key === 'meta_description_default')
                                            <textarea name="{{ $key }}" id="setting_{{ $key }}" rows="4" dir="auto"
                                                      class="{{ $fieldInputClass }} resize-y min-h-[7.5rem] leading-relaxed">{{ $field['value'] }}</textarea>
                                        @else
                                            <input type="{{ $inputType }}" name="{{ $key }}" id="setting_{{ $key }}"
                                                   value="{{ $field['value'] }}"
                                                   autocomplete="{{ $inputType === 'email' ? 'email' : ($inputType === 'url' ? 'url' : 'off') }}"
                                                   class="{{ $fieldInputClass }}"
                                                   @if($inputType === 'url') placeholder="https://…" @elseif($key === 'phone_primary' || $key === 'phone_alt' || $key === 'ambulance_phone') placeholder="e.g. 0700 499 699" @endif>
                                        @endif
                                        @if(! empty($field['hint']))
                                            <p class="{{ $hintClass }}">{{ $field['hint'] }}</p>
                                        @endif
                                        @error($key)
                                            <p class="mt-2 flex items-start gap-2 rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-700 dark:bg-red-950/40 dark:text-red-200" role="alert">
                                                <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                                <span>{{ $message }}</span>
                                            </p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-admin.card>
                @endforeach

                <x-admin.card class="scroll-mt-24 overflow-hidden" padding="false">
                    <div class="border-b border-slate-100 bg-gradient-to-r from-teal-50/80 to-white px-6 py-4 dark:border-slate-700 dark:from-teal-950/30 dark:to-slate-800/40">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Homepage hero</h2>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Background video or full-width image carousel for the home page.</p>
                    </div>
                    <div class="space-y-8 p-6">
                        <fieldset class="min-w-0">
                            <legend class="{{ $labelClass }}">Hero type</legend>
                            <div class="mt-3 inline-flex rounded-xl bg-slate-100 p-1 ring-1 ring-inset ring-slate-200/80 dark:bg-slate-900 dark:ring-slate-600" role="radiogroup" aria-label="Hero type">
                                <label class="relative flex cursor-pointer rounded-lg px-4 py-2.5 text-sm font-medium transition-all focus-within:ring-2 focus-within:ring-teal-500 focus-within:ring-offset-2 dark:focus-within:ring-offset-slate-900"
                                       :class="heroType === 'video' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/80 dark:bg-slate-700 dark:text-white dark:ring-slate-600' : 'text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'">
                                    <input type="radio" name="hero_type" value="video" class="sr-only" x-model="heroType">
                                    <span class="flex items-center gap-2">
                                        <svg class="h-4 w-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Video
                                    </span>
                                </label>
                                <label class="relative flex cursor-pointer rounded-lg px-4 py-2.5 text-sm font-medium transition-all focus-within:ring-2 focus-within:ring-teal-500 focus-within:ring-offset-2 dark:focus-within:ring-offset-slate-900"
                                       :class="heroType === 'carousel' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200/80 dark:bg-slate-700 dark:text-white dark:ring-slate-600' : 'text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'">
                                    <input type="radio" name="hero_type" value="carousel" class="sr-only" x-model="heroType">
                                    <span class="flex items-center gap-2">
                                        <svg class="h-4 w-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Carousel
                                    </span>
                                </label>
                            </div>
                            @error('hero_type')
                                <p class="mt-3 text-xs font-medium text-red-600 dark:text-red-400" role="alert">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <div x-show="heroType === 'video'" x-cloak class="max-w-2xl space-y-2">
                            <label for="hero_video_embed_url" class="{{ $labelClass }}">Embed URL</label>
                            <input type="url" name="hero_video_embed_url" id="hero_video_embed_url"
                                   value="{{ $heroVideoEmbedUrl }}"
                                   class="{{ $inputBase }} font-mono text-xs sm:text-sm {{ $errors->has('hero_video_embed_url') ? $inputError : '' }}"
                                   placeholder="https://www.youtube.com/embed/…"
                                   autocomplete="off"
                                   spellcheck="false">
                            <p class="{{ $hintClass }}">Paste the full <span class="{{ $codeChip }}">iframe src</span> from YouTube (<span class="whitespace-nowrap">/embed/</span>) or Vimeo (<span class="whitespace-nowrap">player.vimeo.com/video/</span>). HTTPS only.</p>
                            @error('hero_video_embed_url')
                                <p class="mt-2 flex items-start gap-2 rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-700 dark:bg-red-950/40 dark:text-red-200" role="alert">
                                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div x-show="heroType === 'carousel'" x-cloak class="max-w-2xl space-y-6">
                            <div class="space-y-2">
                                <label for="hero_managed_carousel_id" class="{{ $labelClass }}">Image source</label>
                                <div class="relative mt-2">
                                    <select name="hero_managed_carousel_id" id="hero_managed_carousel_id" x-model="managedCarouselId"
                                            class="{{ $inputBase }} appearance-none pr-10 {{ $errors->has('hero_managed_carousel_id') ? $inputError : '' }}">
                                        <option value="0">Manual JSON (editor below)</option>
                                        @foreach($carouselsForHero ?? [] as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->slides_count }} {{ Str::plural('slide', $c->slides_count) }})</option>
                                        @endforeach
                                    </select>
                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 dark:text-slate-400" aria-hidden="true">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </span>
                                </div>
                                <p class="{{ $hintClass }}">
                                    Build image sets under
                                    <a href="{{ route('admin.carousels.index') }}" class="font-semibold text-teal-600 underline decoration-teal-600/30 underline-offset-2 hover:text-teal-700 dark:text-teal-400 dark:hover:text-teal-300">Carousels</a>.
                                    When a saved carousel is selected, the JSON field is hidden and ignored.
                                </p>
                                @error('hero_managed_carousel_id')
                                    <p class="mt-2 flex items-start gap-2 rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-700 dark:bg-red-950/40 dark:text-red-200" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="managedCarouselId === '0'" x-cloak class="space-y-2">
                                <label for="hero_carousel_slides_json" class="{{ $labelClass }}">Carousel slides (JSON)</label>
                                <div class="mt-2 overflow-hidden rounded-xl ring-1 ring-inset ring-slate-200 focus-within:ring-2 focus-within:ring-teal-500 dark:ring-slate-600 dark:focus-within:ring-teal-400 {{ $errors->has('hero_carousel_slides_json') ? 'ring-2 ring-red-400 dark:ring-red-500/70' : '' }}">
                                    <textarea name="hero_carousel_slides_json" id="hero_carousel_slides_json" rows="12"
                                              class="block w-full resize-y border-0 bg-slate-50 px-4 py-3 font-mono text-xs leading-relaxed text-slate-800 placeholder:text-slate-400 focus:ring-0 dark:bg-slate-900/80 dark:text-slate-100 sm:text-sm"
                                              spellcheck="false"
                                              placeholder='[{"image":"https://…","alt":"…"}]'>{{ $heroCarouselSlidesJson }}</textarea>
                                </div>
                                <p class="{{ $hintClass }}">Array of <span class="{{ $codeChip }}">image</span> (https URL) and optional <span class="{{ $codeChip }}">alt</span>. Required when “Manual JSON” is selected.</p>
                                @error('hero_carousel_slides_json')
                                    <p class="mt-2 flex items-start gap-2 rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-700 dark:bg-red-950/40 dark:text-red-200" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </x-admin.card>

                <div class="flex flex-col gap-4 rounded-2xl border border-teal-200/60 bg-gradient-to-br from-teal-50/90 via-white to-white p-5 shadow-sm dark:border-teal-900/40 dark:from-teal-950/25 dark:via-slate-800/40 dark:to-slate-800/40 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-900 dark:text-white">Save changes</p>
                        <p class="mt-0.5 text-xs text-slate-600 dark:text-slate-400">General, contact, social, SEO, and hero are saved in one step.</p>
                    </div>
                    <x-admin.button type="submit" variant="primary" size="lg" class="shrink-0 sm:min-w-[10rem]">
                        Save all settings
                    </x-admin.button>
                </div>
            </form>
        @endunless

        <x-admin.card id="profile" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Profile</h2>
            <p class="text-slate-500 dark:text-slate-400">Your admin account details.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <span class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">{{ auth()->user()->email ?? '—' }}</span>
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
