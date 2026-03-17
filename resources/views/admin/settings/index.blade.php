@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <x-admin.breadcrumb :items="['Settings' => null]" />

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Settings</h1>
        <p class="mt-1 text-slate-600">Site-wide settings, profile, backup, and SEO.</p>
    </div>

    <div class="space-y-8 max-w-2xl">
        <x-admin.card id="profile" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Profile</h2>
            <p class="text-slate-500">Your admin account details. Name and email can be updated here (wire to user profile form).</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-sm text-slate-700">{{ auth()->user()->email ?? '—' }}</span>
            </div>
            <div class="mt-6 flex">
                <x-admin.button type="button" variant="outline" size="sm">Edit profile</x-admin.button>
            </div>
        </x-admin.card>

        <x-admin.card>
            <h2 class="mb-4 text-lg font-semibold text-slate-900">General</h2>
            <p class="text-slate-500">Site name, tagline, and default SEO. Form can be wired to Settings model.</p>
            <div class="mt-6 flex">
                <x-admin.button type="button" variant="primary">Save settings</x-admin.button>
            </div>
        </x-admin.card>

        <x-admin.card id="backup" class="scroll-mt-24">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Backup</h2>
            <p class="text-slate-500">Export or backup site data. Database and media backups can be run from here (wire to backup job/command).</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <x-admin.button type="button" variant="outline" size="sm">Export database</x-admin.button>
                <x-admin.button type="button" variant="outline" size="sm">Backup media</x-admin.button>
            </div>
        </x-admin.card>
    </div>
@endsection
