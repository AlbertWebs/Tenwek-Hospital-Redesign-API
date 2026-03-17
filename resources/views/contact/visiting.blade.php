@extends('layouts.app')
@section('title', 'Visiting Hours')
@section('content')
    <x-page title="Visiting Hours" :breadcrumbs="['Contact' => route('contact.index'), 'Visiting Hours' => null]">
        <p>Information for visitors and families.</p>
        <div class="mt-6 not-prose overflow-x-auto">
            <table class="min-w-full border border-slate-200 rounded-lg">
                <thead class="bg-slate-50"><tr><th class="text-left p-3 text-sm font-semibold text-slate-700">Area</th><th class="text-left p-3 text-sm font-semibold text-slate-700">Hours</th></tr></thead>
                <tbody class="divide-y divide-slate-200">
                    <tr><td class="p-3 text-slate-600">General</td><td class="p-3 text-slate-600">[ Hours placeholder ]</td></tr>
                    <tr><td class="p-3 text-slate-600">ICU / Critical care</td><td class="p-3 text-slate-600">[ Hours placeholder ]</td></tr>
                </tbody>
            </table>
        </div>
    </x-page>
@endsection
