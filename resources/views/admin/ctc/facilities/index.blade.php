@extends('admin.layouts.app')

@section('title', 'CTC Facilities')

@section('content')
    <x-admin.breadcrumb :items="['CTC' => null, 'Facilities' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Facilities</h1>
        <p class="mt-1 text-slate-600">Manage CTC facilities (Cardiac ICU, Operating Theatres, etc.).</p>
    </div>
    <x-admin.card><p class="text-slate-500">Facilities list and CRUD can be added here.</p></x-admin.card>
@endsection
