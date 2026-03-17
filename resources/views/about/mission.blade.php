@extends('layouts.app')
@section('title', 'Mission, Vision & Values')
@section('content')
    <x-page title="Mission, Vision & Core Values" :breadcrumbs="['About' => route('about.tenwek'), 'Mission, Vision & Values' => null]">
        <p>Our mission, vision, and core values guide everything we do at Tenwek Hospital.</p>
        <h2 class="text-xl font-semibold mt-6">Mission</h2>
        <p>[ Mission statement placeholder ]</p>
        <h2 class="text-xl font-semibold mt-6">Vision</h2>
        <p>[ Vision statement placeholder ]</p>
        <h2 class="text-xl font-semibold mt-6">Core Values</h2>
        <ul class="list-disc pl-6 space-y-1"> <li>[ Value 1 ]</li> <li>[ Value 2 ]</li> <li>[ Value 3 ]</li> </ul>
    </x-page>
@endsection
