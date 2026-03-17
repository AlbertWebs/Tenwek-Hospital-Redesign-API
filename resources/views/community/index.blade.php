@extends('layouts.app')
@section('title', 'Community & Mission')
@section('content')
    <x-page title="Community & Mission" :breadcrumbs="['Community' => null]">
        <p>Our spiritual ministry, community outreach, and global health partnerships.</p>
        <ul class="mt-4 list-disc pl-6 space-y-1">
            <li>Spiritual Ministry</li>
            <li>Community Outreach</li>
            <li>Global Health Partnerships</li>
            <li><a href="{{ route('community.index') }}/patient-stories" class="text-teal-600 hover:text-teal-700">Patient Stories</a></li>
        </ul>
    </x-page>
@endsection
