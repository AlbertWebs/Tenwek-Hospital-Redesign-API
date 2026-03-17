@extends('admin.layouts.app')

@section('title', 'Career Opportunities')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Career Opportunities' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Career Opportunities</h1>
            <p class="mt-1 text-slate-600">Manage job listings shown on the public Careers page.</p>
        </div>
        <x-admin.button href="{{ route('admin.careers.create') }}" variant="primary" size="md">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add job
        </x-admin.button>
    </div>

    <x-admin.card padding="false">
        @if($careers->isEmpty())
            <div class="p-12 text-center">
                <p class="text-slate-500">No job listings yet.</p>
                <x-admin.button href="{{ route('admin.careers.create') }}" variant="primary" size="md" class="mt-4">Add your first job</x-admin.button>
            </div>
        @else
            <x-admin.table>
                <x-slot name="head">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Department</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Type</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Closes</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($careers as $career)
                        <tr class="group hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.careers.edit', $career) }}" class="font-medium text-slate-900 hover:text-teal-600">{{ $career->title }}</a>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">{{ $career->department ?? '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">{{ $career->employment_type ?? '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">{{ $career->closing_date ? $career->closing_date->format('M j, Y') : '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $career->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $career->is_published ? 'Published' : 'Draft' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('admin.careers.edit', $career) }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">Edit</a>
                                <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="inline ml-2" x-data onsubmit="return confirm('Delete this job listing?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-admin.table>
            @if($careers->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">{{ $careers->links() }}</div>
            @endif
        @endif
    </x-admin.card>
@endsection
