@extends('admin.layouts.app')

@section('title', 'Add carousel')

@section('content')
    <x-admin.breadcrumb :items="['Carousels' => route('admin.carousels.index'), 'Add carousel' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Add carousel</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Choose a name and URL slug, then add images on the next screen.</p>
    </div>

    <form action="{{ route('admin.carousels.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        <div class="space-y-1.5">
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm"
                   placeholder="e.g. Homepage hero">
            @error('name')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="space-y-1.5">
            <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug <span class="font-normal text-slate-500">(optional)</span></label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                   class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm"
                   placeholder="auto from name if left empty">
            <p class="text-sm text-slate-500 dark:text-slate-400">Lowercase letters, numbers, and hyphens only.</p>
            @error('slug')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="space-y-1.5">
            <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description <span class="font-normal text-slate-500">(optional)</span></label>
            <textarea name="description" id="description" rows="3"
                      class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center gap-3">
            <x-admin.button type="submit" variant="primary">Create carousel</x-admin.button>
            <a href="{{ route('admin.carousels.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">Cancel</a>
        </div>
    </form>
@endsection
