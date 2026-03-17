@extends('layouts.app')

@section('title', 'Cardiothoracic Centre')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        <nav class="text-sm text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-teal-600">Home</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700">Cardiothoracic Centre</span>
        </nav>
        <h1 class="text-3xl font-bold text-slate-900">The Cardiothoracic Centre</h1>
        <p class="mt-4 text-lg text-slate-600 max-w-3xl">Our flagship Cardiothoracic Centre is a regional centre of excellence for adult and paediatric cardiac surgery, offering life-saving procedures, dedicated clinics, and fellowship training.</p>
        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ url('/cardiothoracic-centre/clinical-services/adult-cardiac') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Clinical Services</h2>
                <p class="mt-1 text-sm text-slate-600">Adult &amp; paediatric cardiac surgery, cardiothoracic surgery</p>
            </a>
            <a href="{{ url('/cardiothoracic-centre/clinics/cardiac') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Clinics</h2>
                <p class="mt-1 text-sm text-slate-600">Cardiac clinic, pre-op assessment, follow-up care</p>
            </a>
            <a href="{{ url('/cardiothoracic-centre/facilities/cardiac-icu') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Facilities</h2>
                <p class="mt-1 text-sm text-slate-600">Cardiac ICU, operating theatres, diagnostic support</p>
            </a>
            <a href="{{ route('training.fellowship') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Training</h2>
                <p class="mt-1 text-sm text-slate-600">Cardiothoracic Surgery Fellowship</p>
            </a>
        </div>
    </div>
@endsection
