@extends('admin.layouts.app')

@section('title', 'Add Page')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Add Page' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Add Page</h1>
        <p class="mt-1 text-slate-600">Create a new page. You can add sections after saving.</p>
    </div>

    <x-admin.card class="max-w-2xl">
        <form action="{{ route('admin.pages.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('title') border-red-500 @enderror" />
                @error('title')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="auto-generated from title"
                       class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('slug') border-red-500 @enderror" />
                @error('slug')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-slate-500">Leave blank to generate from title. URL: /your-slug</p>
            </div>
            <div>
                <label for="template" class="block text-sm font-medium text-slate-700">Template</label>
                <select name="template" id="template" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                    <option value="default" {{ old('template', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                    <option value="home" {{ old('template') === 'home' ? 'selected' : '' }}>Home</option>
                    <option value="contact" {{ old('template') === 'contact' ? 'selected' : '' }}>Contact</option>
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" id="status" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <x-admin.button type="submit" variant="primary">Create Page</x-admin.button>
                <a href="{{ route('admin.pages.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
            </div>
        </form>
    </x-admin.card>
@endsection
