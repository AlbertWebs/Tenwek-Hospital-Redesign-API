@extends('admin.layouts.app')

@section('title', 'CTC Clinics')

@section('content')
    <x-admin.breadcrumb :items="['CTC' => null, 'Clinics' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Clinics</h1>
        <p class="mt-1 text-slate-600">Manage CTC clinics (Cardiac Clinic, Pre-op, Follow-up).</p>
    </div>
    <x-admin.card><p class="text-slate-500">Clinics list and CRUD can be added here.</p></x-admin.card>
@endsection
