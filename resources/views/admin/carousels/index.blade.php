@extends('admin.layouts.app')

@section('title', 'Carousels')

@section('content')
    <x-admin.breadcrumb :items="['Content' => route('admin.media.index'), 'Carousels' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Carousels</h1>
            <p class="mt-1 text-slate-600 dark:text-slate-400">Create image sets for heroes and banners. Upload slides on each carousel’s edit page.</p>
        </div>
        <x-admin.button href="{{ route('admin.carousels.create') }}" variant="primary" size="md">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add carousel
        </x-admin.button>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900 dark:border-teal-800 dark:bg-teal-950/40 dark:text-teal-100">
            {{ session('status') }}
        </div>
    @endif

    <x-admin.card padding="false">
        @if($carousels->isEmpty())
            <div class="p-12 text-center">
                <p class="text-slate-500 dark:text-slate-400">No carousels yet.</p>
                <x-admin.button href="{{ route('admin.carousels.create') }}" variant="primary" size="md" class="mt-4">Create your first carousel</x-admin.button>
            </div>
        @else
            <x-admin.table>
                <x-slot name="head">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Name</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Slug</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Slides</th>
                        <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Actions</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($carousels as $carousel)
                        <tr class="group hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.carousels.edit', $carousel) }}" class="font-medium text-slate-900 hover:text-teal-600 dark:text-white dark:hover:text-teal-400">{{ $carousel->name }}</a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $carousel->slug }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $carousel->slides_count }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('admin.carousels.edit', $carousel) }}" class="text-sm font-medium text-teal-600 hover:text-teal-700 dark:text-teal-400">Edit</a>
                                <form action="{{ route('admin.carousels.destroy', $carousel) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this carousel and all its slides? Images will be removed from storage.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700 dark:text-red-400">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-admin.table>
        @endif
    </x-admin.card>
@endsection
