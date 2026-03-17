@extends('layouts.app')
@section('title', 'Surgical Services')
@section('content')
    <x-page title="Surgical Services" :breadcrumbs="['Clinical Services' => route('clinical-services.index'), 'Surgical Services' => null]">
        <p>Comprehensive surgical services including OB/GYN, orthopaedic, and cardiothoracic surgery.</p>
        <ul class="mt-4 list-disc pl-6 space-y-1">
            <li><a href="{{ url('/clinical-services/surgical-services/ob-gyn') }}" class="text-teal-600 hover:text-teal-700">OB/GYN Surgeries</a></li>
            <li><a href="{{ url('/clinical-services/surgical-services/orthopedic') }}" class="text-teal-600 hover:text-teal-700">Orthopedic Surgeries</a></li>
            <li><a href="{{ url('/clinical-services/surgical-services/cardiothoracic') }}" class="text-teal-600 hover:text-teal-700">Cardiothoracic Surgeries</a></li>
        </ul>
    </x-page>
@endsection
