@extends('admin.layouts.app')

@section('title', 'Edit: ' . $page->title)

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), $page->title => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $page->isListing() ? 'Page settings' : 'Edit Page' }}</h1>
            <p class="mt-1 text-slate-600">/{{ $page->slug }}</p>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $page->isListing() ? 'bg-amber-50 text-amber-700' : 'bg-teal-50 text-teal-700' }}">
                    {{ $page->isListing() ? 'Listing / CMS' : 'Managed' }}
                </span>
                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $page->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $page->status }}</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ $page->slug === 'home' ? url('/') : url('/' . $page->slug) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View
            </a>
            <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition">Back to pages</a>
        </div>
    </div>

    {{-- Page details form --}}
    <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        <x-admin.card>
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Page details</h2>
            <div class="grid gap-6 sm:grid-cols-1">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('title') border-red-500 @enderror" />
                    @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" required
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('slug') border-red-500 @enderror" />
                    @error('slug')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="template" class="block text-sm font-medium text-slate-700">Template</label>
                        <select name="template" id="template" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="default" {{ old('template', $page->template) === 'default' ? 'selected' : '' }}>Default</option>
                            <option value="home" {{ old('template', $page->template) === 'home' ? 'selected' : '' }}>Home</option>
                            <option value="contact" {{ old('template', $page->template) === 'contact' ? 'selected' : '' }}>Contact</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>
                @if($page->isListing())
                    <div>
                        <label for="intro" class="block text-sm font-medium text-slate-700">Intro (header text on listing page)</label>
                        <textarea name="intro" id="intro" rows="4" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('intro', $page->intro) }}</textarea>
                        @error('intro')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                @endif
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta title (SEO)</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta description (SEO)</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
            </div>
            <div class="mt-6 flex items-center gap-3">
                <x-admin.button type="submit" variant="primary">Save changes</x-admin.button>
                <a href="{{ route('admin.pages.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
            </div>
        </x-admin.card>
    </form>

    @if($page->isListing())
        {{-- Listing page: Manage content CTA --}}
        <x-admin.card class="mt-8">
            <div class="flex flex-col items-center justify-center py-10 text-center sm:py-12">
                <div class="rounded-2xl bg-amber-50 p-6 ring-1 ring-amber-100">
                    <h3 class="text-lg font-semibold text-amber-900">Manage listing content</h3>
                    <p class="mt-2 text-sm text-amber-700">This page displays content from the database. Use the link below to manage {{ $page->listing_type === 'careers' ? 'job postings' : 'news posts' }}.</p>
                    <a href="{{ route($page->getListingAdminRoute()) }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-amber-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-amber-700 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        {{ $page->getListingAdminLabel() }}
                    </a>
                </div>
            </div>
        </x-admin.card>
    @else
        <div class="mt-8" x-data="{ addOpen: false }">
        {{-- Managed page: Section builder --}}
        <x-admin.card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Sections</h2>
                    <button type="button" @click="addOpen = true" class="inline-flex items-center gap-2 rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-teal-700 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add section
                    </button>
                </div>
            </x-slot>

            @if($page->sections->isEmpty())
                <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    <p class="mt-4 text-slate-500">No sections yet. Add hero, content, image, or CTA sections to build your page.</p>
                    <button type="button" @click="addOpen = true" class="mt-4 text-sm font-medium text-teal-600 hover:text-teal-700">+ Add your first section</button>
                </div>
            @else
                <ul class="space-y-4">
                    @foreach($page->sections as $section)
                        <li class="rounded-xl border border-slate-200 bg-white transition hover:border-slate-300" x-data="{ editOpen: false }">
                            <div class="flex items-center gap-3 px-4 py-3">
                                <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">{{ $section->type }}</span>
                                <span class="flex-1 font-medium text-slate-800">{{ $section->name ?: ucfirst($section->type) }}</span>
                                <div class="flex items-center gap-1">
                                    <button type="button" @click="editOpen = !editOpen" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    @if(!$loop->first)
                                        <form action="{{ route('admin.pages.sections.move', [$page, $section, 'up']) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600" title="Move up"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg></button>
                                        </form>
                                    @endif
                                    @if(!$loop->last)
                                        <form action="{{ route('admin.pages.sections.move', [$page, $section, 'down']) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600" title="Move down"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" method="POST" class="inline" onsubmit="return confirm('Remove this section?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-red-50 hover:text-red-600" title="Remove"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </form>
                                </div>
                            </div>
                            <div x-show="editOpen" x-cloak class="border-t border-slate-100 bg-slate-50/50 px-4 py-4">
                                @include('admin.pages.partials.section-form', ['section' => $section, 'page' => $page])
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-admin.card>

        {{-- Add section modal --}}
        <div x-show="addOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="add-section-title" role="dialog" aria-modal="true">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="addOpen" x-transition class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="addOpen = false"></div>
                <div x-show="addOpen" x-transition class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
                    <h3 id="add-section-title" class="text-lg font-semibold text-slate-900">Add section</h3>
                    <p class="mt-1 text-sm text-slate-500">Choose a section type to add to this page.</p>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        @foreach(['hero' => 'Hero', 'content' => 'Content', 'image' => 'Image', 'cta' => 'CTA'] as $type => $label)
                            <form action="{{ route('admin.pages.sections.store', $page) }}" method="POST" class="block">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}" />
                                <input type="hidden" name="name" value="{{ $label }}" />
                                <button type="submit" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-left text-sm font-medium text-slate-700 shadow-sm hover:border-teal-300 hover:bg-teal-50/50 transition">
                                    {{ $label }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" @click="addOpen = false" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endif
@endsection
