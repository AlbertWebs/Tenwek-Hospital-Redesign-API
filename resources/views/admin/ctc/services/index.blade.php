@extends('admin.layouts.app')

@section('title', 'CTC Cardiac Services')

@section('content')
    <x-admin.breadcrumb :items="['CTC' => null, 'Cardiac Services' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Cardiac Services</h1>
            <p class="mt-1 text-slate-600">Manage CTC clinical services (adult cardiac, pediatric, etc.).</p>
        </div>
        <x-admin.button variant="primary" size="md">Add Service</x-admin.button>
    </div>

    <x-admin.card padding="false">
        @if($items->isEmpty())
            <div class="p-12 text-center text-slate-500">No CTC services yet.</div>
        @else
            <x-admin.table>
                <x-slot name="head">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Slug</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Visible</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($items as $item)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $item->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">/{{ $item->slug }}</td>
                            <td class="px-6 py-4">{{ $item->is_visible ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-admin.table>
            @if($items->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">{{ $items->links() }}</div>
            @endif
        @endif
    </x-admin.card>
@endsection
