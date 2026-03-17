@extends('layouts.app')
@section('title', 'Leadership')
@section('content')
    <x-page title="Leadership" :breadcrumbs="['About' => route('about.tenwek'), 'Leadership' => null]">
        <p>Meet the leadership team at Tenwek Hospital.</p>
        <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 not-prose">
            <div class="p-4 rounded-lg border border-slate-200 bg-white">
                <div class="w-20 h-20 rounded-full bg-slate-200 mb-3"></div>
                <h3 class="font-semibold text-slate-900">[ Name ]</h3>
                <p class="text-sm text-slate-600">[ Role ]</p>
            </div>
            <div class="p-4 rounded-lg border border-slate-200 bg-white">
                <div class="w-20 h-20 rounded-full bg-slate-200 mb-3"></div>
                <h3 class="font-semibold text-slate-900">[ Name ]</h3>
                <p class="text-sm text-slate-600">[ Role ]</p>
            </div>
        </div>
    </x-page>
@endsection
