@extends('admin.layouts.app')

@section('title', 'Add job')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Career Opportunities' => route('admin.careers.index'), 'Add job' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Add job listing</h1>
        <p class="mt-1 text-slate-600">This will appear on the public Careers page when published.</p>
    </div>

    <form action="{{ route('admin.careers.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @include('admin.careers._form', ['career' => $career])
        <div class="flex items-center gap-3">
            <x-admin.button type="submit" variant="primary">Create job listing</x-admin.button>
            <a href="{{ route('admin.careers.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
        </div>
    </form>
@endsection
