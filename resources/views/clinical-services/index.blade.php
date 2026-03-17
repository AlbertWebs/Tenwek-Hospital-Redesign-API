@extends('layouts.app')

@section('title', 'Clinical Services')

@section('content')
    <x-page title="Clinical Services" :breadcrumbs="['Clinical Services' => null]">
        <p>Tenwek Hospital offers a full range of clinical services, from outpatient care to specialised surgery and emergency care.</p>
        <div class="mt-8 grid sm:grid-cols-3 gap-6 not-prose">
            <a href="{{ route('clinical-services.outpatient') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Outpatient &amp; Clinics</h2>
                <p class="mt-1 text-sm text-slate-600">General outpatient, chest, cardiac, oncology, endoscopy, fast track, palliative care</p>
            </a>
            <a href="{{ route('clinical-services.surgical') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Surgical Services</h2>
                <p class="mt-1 text-sm text-slate-600">OB/GYN, orthopaedic, cardiothoracic surgeries</p>
            </a>
            <a href="{{ url('/clinical-services/specialized/eye') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Specialized Departments</h2>
                <p class="mt-1 text-sm text-slate-600">Eye, dental, diagnostic services, casualty / A&amp;E</p>
            </a>
        </div>
    </x-page>
@endsection
