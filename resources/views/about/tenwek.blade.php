@extends('layouts.app')

@section('title', 'About Tenwek Hospital')

@section('content')
    <x-page title="About Tenwek Hospital" :breadcrumbs="['About' => route('about.tenwek')]">
        <p class="lead">Tenwek Hospital is a mission hospital in Bomet County, Kenya, providing comprehensive medical care to the community and the wider region.</p>
        <p>With a legacy of service and clinical excellence, we combine expert care with compassionate, faith-based ministry. Our facilities include general and specialist outpatient clinics, surgical services, and the flagship Cardiothoracic Centre.</p>
        <p><a href="{{ route('about.mission') }}" class="text-teal-600 font-medium hover:text-teal-700">Mission, Vision &amp; Core Values →</a></p>
    </x-page>
@endsection
