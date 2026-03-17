@extends('layouts.app')
@section('title', 'Outpatient & Clinics')
@section('content')
    <x-page title="Outpatient & Clinics" :breadcrumbs="['Clinical Services' => route('clinical-services.index'), 'Outpatient & Clinics' => null]">
        <p>General and specialist outpatient clinics at Tenwek Hospital.</p>
        <ul class="mt-4 list-disc pl-6 space-y-1">
            <li>General Outpatient Clinic</li>
            <li>Chest Clinic</li>
            <li>Orthopedic Clinic</li>
            <li>Oncology Clinic</li>
            <li>Endoscopy Clinic</li>
            <li>Cardiac Clinic</li>
            <li>Fast Track Clinic</li>
            <li>Palliative Care Unit</li>
        </ul>
    </x-page>
@endsection
