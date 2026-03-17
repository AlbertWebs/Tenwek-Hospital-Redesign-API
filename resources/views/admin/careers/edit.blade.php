@extends('admin.layouts.app')

@section('title', 'Edit: ' . $career->title)

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Career Opportunities' => route('admin.careers.index'), $career->title => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Edit job listing</h1>
            <p class="mt-1 text-slate-600">{{ $career->slug }}</p>
        </div>
        <a href="{{ route('careers.index') }}" target="_blank" rel="noopener" class="text-sm font-medium text-teal-600 hover:text-teal-700">View Careers page →</a>
    </div>

    <form action="{{ route('admin.careers.update', $career) }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')
        @include('admin.careers._form', ['career' => $career])
        <div class="flex items-center gap-3">
            <x-admin.button type="submit" variant="primary">Save changes</x-admin.button>
            <a href="{{ route('admin.careers.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
        </div>
    </form>
@endsection
