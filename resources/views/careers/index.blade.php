@extends('layouts.app')
@section('title', 'Careers')
@section('content')
    <x-page title="Careers" :breadcrumbs="['Careers' => null]">
        <p>Work at Tenwek Hospital. View open positions and internship opportunities.</p>
        <div class="mt-8 not-prose">
            <a href="{{ route('careers.index') }}#positions" class="text-teal-600 font-medium hover:text-teal-700">Open Positions</a>
            <span class="mx-2">·</span>
            <a href="{{ route('careers.index') }}#internships" class="text-teal-600 font-medium hover:text-teal-700">Internship Opportunities</a>
        </div>
        <p class="mt-6">[ Work at Tenwek / positions list placeholder ]</p>
    </x-page>
@endsection
