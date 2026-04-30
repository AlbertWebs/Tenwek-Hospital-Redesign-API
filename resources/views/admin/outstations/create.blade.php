@extends('admin.layouts.app')

@section('title', 'Add outstation')

@section('content')
    <x-admin.breadcrumb :items="['Pages' => route('admin.pages.index'), 'Outstations' => route('admin.outstations.index'), 'Add' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Add outstation</h1>
        <p class="mt-1 text-slate-600">Visible on the site when published and listed on the Outstations map when latitude and longitude are set.</p>
    </div>

    <form action="{{ route('admin.outstations.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @include('admin.outstations._form', ['outstation' => $outstation])
        <div class="flex items-center gap-3">
            <x-admin.button type="submit" variant="primary">Create outstation</x-admin.button>
            <a href="{{ route('admin.outstations.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Cancel</a>
        </div>
    </form>
@endsection
