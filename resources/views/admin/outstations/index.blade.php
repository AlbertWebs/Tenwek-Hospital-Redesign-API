@extends('admin.layouts.app')

@section('title', 'Outstations')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Outstations' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Outstations</h1>
            <p class="mt-1 text-slate-600">Manage satellite locations shown on the public Outstations page.</p>
        </div>
        <x-admin.button href="{{ route('admin.outstations.create') }}" variant="primary" size="md">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add outstation
        </x-admin.button>
    </div>

    <x-admin.card padding="false">
        @if($outstations->isEmpty())
            <div class="p-12 text-center">
                <p class="text-slate-500">No outstations yet.</p>
                <x-admin.button href="{{ route('admin.outstations.create') }}" variant="primary" size="md" class="mt-4">Add your first outstation</x-admin.button>
            </div>
        @else
            <x-admin.table>
                <x-slot name="head">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Order</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Map</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($outstations as $outstation)
                        <tr class="group hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.outstations.edit', $outstation) }}" class="font-medium text-slate-900 hover:text-teal-600">{{ $outstation->name }}</a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">{{ $outstation->order }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">{{ $outstation->hasMapCoordinates() ? 'Yes' : '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $outstation->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $outstation->is_published ? 'Published' : 'Draft' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('outstations.show', $outstation) }}" target="_blank" class="text-sm text-slate-600 hover:text-teal-700">View</a>
                                <span class="mx-1 text-slate-300">|</span>
                                <a href="{{ route('admin.outstations.edit', $outstation) }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">Edit</a>
                                <form action="{{ route('admin.outstations.destroy', $outstation) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this outstation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-admin.table>
            @if($outstations->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">{{ $outstations->links() }}</div>
            @endif
        @endif
    </x-admin.card>
@endsection
