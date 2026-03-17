@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">All Pages</h1>
            <p class="mt-1 text-slate-600">Managed and listing pages. Edit content or manage jobs and posts by type.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.pages.sync') }}" method="POST" class="inline">
                @csrf
                <x-admin.button type="submit" variant="outline" size="md">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Sync pages
                </x-admin.button>
            </form>
            <x-admin.button href="{{ route('admin.pages.create') }}" variant="primary" size="md">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Page
            </x-admin.button>
        </div>
    </div>

    <x-admin.card padding="false">
        <x-admin.table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Path</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Type</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Updated</th>
                    <th scope="col" class="relative w-12 px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500"><span class="sr-only">Actions</span></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($pages as $row)
                    <tr class="group hover:bg-slate-50/80 transition" x-data="{ open: false, deleteOpen: false }">
                        <td class="whitespace-nowrap px-6 py-4">
                            @if($row->page)
                                <a href="{{ $row->type === 'listing' ? route('admin.pages.edit', $row->page) : route('admin.pages.edit', $row->page) }}" class="font-medium text-slate-900 hover:text-teal-600">{{ $row->title }}</a>
                            @else
                                <span class="font-medium text-slate-900">{{ $row->title }}</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">/{{ $row->path ?: '(home)' }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if($row->type === 'listing')
                                <span class="rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700">Listing / CMS</span>
                            @elseif($row->type === 'managed')
                                <span class="rounded-full bg-teal-50 px-2.5 py-0.5 text-xs font-medium text-teal-700">Managed</span>
                            @else
                                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">Site page</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if($row->page)
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $row->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $row->status }}</span>
                            @else
                                <span class="rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">Live</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                            {{ $row->updated_at ? $row->updated_at->format('M j, Y') : '—' }}
                        </td>
                        <td class="relative whitespace-nowrap px-6 py-4 text-right">
                            <div class="flex justify-end" @click.outside="open = false">
                                <button type="button" @click="open = !open" class="inline-flex items-center rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition" aria-haspopup="true" :aria-expanded="open">
                                    <span class="sr-only">Actions</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                                </button>
                                <div x-show="open" x-cloak x-transition
                                     class="absolute right-6 mt-1 w-48 rounded-xl border border-slate-200 bg-white py-1 shadow-lg z-10">
                                    <a href="{{ $row->path === '' ? url('/') : url('/' . $row->path) }}" target="_blank" rel="noopener"
                                       class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        View
                                    </a>
                                    @if($row->type === 'listing' && !empty($row->admin_route))
                                        <a href="{{ route($row->admin_route) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-amber-700 hover:bg-amber-50 font-medium">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            {{ $row->admin_label ?? 'Manage Content' }}
                                        </a>
                                    @endif
                                    @if($row->page)
                                        <a href="{{ route('admin.pages.edit', $row->page) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-teal-700 hover:bg-teal-50 font-medium">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            {{ $row->type === 'listing' ? 'Edit page (header)' : 'Edit page' }}
                                        </a>
                                        <button type="button" @click="open = false; deleteOpen = true" class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>

                            @if($row->page)
                                {{-- Delete confirmation modal --}}
                                <div x-show="deleteOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="delete-title" role="dialog" aria-modal="true">
                                    <div class="flex min-h-full items-center justify-center p-4">
                                        <div x-show="deleteOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="deleteOpen = false"></div>
                                        <div x-show="deleteOpen" x-transition class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
                                            <h3 id="delete-title" class="text-lg font-semibold text-slate-900">Delete page?</h3>
                                            <p class="mt-2 text-sm text-slate-600">This will remove "{{ $row->title }}" and all its sections. This cannot be undone.</p>
                                            <div class="mt-6 flex gap-3 justify-end">
                                                <button type="button" @click="deleteOpen = false" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
                                                <form action="{{ route('admin.pages.destroy', $row->page) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-admin.table>
    </x-admin.card>
@endsection
