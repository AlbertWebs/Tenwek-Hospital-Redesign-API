@extends('admin.layouts.app')

@section('title', 'Edit carousel')

@section('content')
    <x-admin.breadcrumb :items="['Carousels' => route('admin.carousels.index'), $carousel->name => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Edit carousel</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Update details and manage slides (upload, replace image, alt text, remove).</p>
    </div>

    @if (session('status'))
        <div class="mb-6 max-w-4xl rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900 dark:border-teal-800 dark:bg-teal-950/40 dark:text-teal-100">
            {{ session('status') }}
        </div>
    @endif

    <div class="max-w-4xl space-y-8">
        <x-admin.card>
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Details</h2>
            <form action="{{ route('admin.carousels.update', $carousel) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $carousel->name) }}" required
                           class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                    @error('name')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $carousel->slug) }}" required
                           class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                    @error('slug')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">{{ old('description', $carousel->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <x-admin.button type="submit" variant="primary" size="sm">Save details</x-admin.button>
            </form>
        </x-admin.card>

        <x-admin.card>
            <h2 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">Slides</h2>
            <p class="mb-6 text-sm text-slate-500 dark:text-slate-400">Images are stored under <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">storage/app/public/carousels/{{ $carousel->id }}</code>. Ensure <code class="rounded bg-slate-100 px-1 dark:bg-slate-700">php artisan storage:link</code> has been run on the server.</p>

            @error('image')
                <p class="mb-4 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            @if($carousel->slides->isEmpty())
                <p class="mb-6 text-sm text-slate-600 dark:text-slate-300">No slides yet. Add one below.</p>
            @else
                <ul class="mb-8 space-y-6 divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($carousel->slides as $slide)
                        <li class="pt-6 first:pt-0">
                            <div class="flex flex-col gap-6 sm:flex-row sm:items-start">
                                <div class="shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 dark:border-slate-600 dark:bg-slate-800" style="width: 200px; max-height: 120px;">
                                    <img src="{{ $slide->image_url }}" alt="{{ $slide->alt_text ?? '' }}" class="h-full w-full object-cover" loading="lazy" width="200" height="120">
                                </div>
                                <div class="min-w-0 flex-1 space-y-4">
                                    <form action="{{ route('admin.carousels.slides.update', [$carousel, $slide]) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="space-y-1.5">
                                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="alt_{{ $slide->id }}">Alt text</label>
                                            <input type="text" name="alt_text" id="alt_{{ $slide->id }}" value="{{ $slide->alt_text }}"
                                                   class="block w-full max-w-md rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="img_{{ $slide->id }}">Replace image</label>
                                            <input type="file" name="image" id="img_{{ $slide->id }}" accept="image/jpeg,image/png,image/webp,image/gif"
                                                   class="block w-full max-w-md text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-teal-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-teal-700 hover:file:bg-teal-100 dark:text-slate-300 dark:file:bg-slate-700 dark:file:text-teal-200">
                                            <p class="text-xs text-slate-500 dark:text-slate-400">Leave empty to keep the current image. Max 10&nbsp;MB.</p>
                                        </div>
                                        @error('alt_text')
                                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                        <div class="flex flex-wrap items-center gap-3">
                                            <x-admin.button type="submit" variant="outline" size="sm">Update slide</x-admin.button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.carousels.slides.destroy', [$carousel, $slide]) }}" method="POST" class="inline" onsubmit="return confirm('Remove this slide?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin.button type="submit" variant="danger" size="sm">Delete slide</x-admin.button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50/50 p-6 dark:border-slate-600 dark:bg-slate-800/30">
                <h3 class="mb-3 text-sm font-semibold text-slate-900 dark:text-white">Add slide</h3>
                <form action="{{ route('admin.carousels.slides.store', $carousel) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label for="new_image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image <span class="text-red-500">*</span></label>
                        <input type="file" name="image" id="new_image" required accept="image/jpeg,image/png,image/webp,image/gif"
                               class="block w-full max-w-md text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-teal-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-teal-700 dark:text-slate-300">
                        @error('image')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label for="new_alt" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alt text <span class="font-normal text-slate-500">(optional)</span></label>
                        <input type="text" name="alt_text" id="new_alt" value="{{ old('alt_text') }}"
                               class="block w-full max-w-md rounded-xl border-slate-300 bg-white shadow-sm focus:border-teal-500 focus:ring-teal-500 dark:border-slate-600 dark:bg-slate-800 dark:text-white sm:text-sm">
                    </div>
                    <x-admin.button type="submit" variant="primary" size="sm">Upload slide</x-admin.button>
                </form>
            </div>
        </x-admin.card>

        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('admin.carousels.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">← Back to carousels</a>
            <form action="{{ route('admin.carousels.destroy', $carousel) }}" method="POST" class="inline" onsubmit="return confirm('Delete this entire carousel and all slides?')">
                @csrf
                @method('DELETE')
                <x-admin.button type="submit" variant="danger" size="sm">Delete carousel</x-admin.button>
            </form>
        </div>
    </div>
@endsection
