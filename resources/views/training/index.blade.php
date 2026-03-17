@extends('layouts.app')
@section('title', 'Training & Education')
@section('content')
    <x-page title="Training & Education" :breadcrumbs="['Training' => null]">
        <p>Tenwek Hospital offers medical training including residency programmes and the Cardiothoracic Surgery Fellowship. We also partner with Tenwek Hospital College for the School of Health Sciences and School of Chaplaincy.</p>
        <div class="mt-8 grid sm:grid-cols-2 gap-6 not-prose">
            <a href="{{ route('training.fellowship') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Cardiothoracic Surgery Fellowship</h2>
                <p class="mt-1 text-sm text-slate-600">Fellowship training at the CTC</p>
            </a>
            <a href="{{ route('training.index') }}" class="block p-6 rounded-xl border border-slate-200 hover:border-teal-300 bg-white">
                <h2 class="font-semibold text-slate-900">Residency Programmes</h2>
                <p class="mt-1 text-sm text-slate-600">[ Residency info ]</p>
            </a>
        </div>
        <p class="mt-6 text-sm text-slate-600">External: <a href="#" target="_blank" rel="noopener noreferrer" class="text-teal-600">School of Health Sciences</a> · <a href="#" target="_blank" rel="noopener noreferrer" class="text-teal-600">School of Chaplaincy</a></p>
    </x-page>
@endsection
