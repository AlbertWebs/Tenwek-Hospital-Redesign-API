@extends('admin.layouts.app')

@section('title', 'Edit outstation')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Outstations' => route('admin.outstations.index'), $outstation->name => null]" />

    <div class="mb-8 flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Edit outstation</h1>
            <p class="mt-1 text-slate-600">{{ $outstation->name }}</p>
        </div>
        <a href="{{ route('outstations.show', $outstation) }}" target="_blank" class="text-sm font-medium text-teal-600 hover:text-teal-700">Open public page ↗</a>
    </div>

    <form action="{{ route('admin.outstations.update', $outstation) }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')
        @include('admin.outstations._form', ['outstation' => $outstation])
        <div class="flex items-center gap-3">
            <x-admin.button type="submit" variant="primary">Save changes</x-admin.button>
            <a href="{{ route('admin.outstations.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
        </div>
    </form>
@endsection
