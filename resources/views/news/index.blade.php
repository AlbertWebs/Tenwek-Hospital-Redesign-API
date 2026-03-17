@extends('layouts.app')
@section('title', 'News & Updates')
@section('content')
    <x-page title="News & Updates" :breadcrumbs="['News' => null]">
        <p>Hospital news, announcements, and events.</p>
        <div class="mt-8 space-y-4 not-prose">
            <article class="p-4 border border-slate-200 rounded-lg">
                <time class="text-sm text-slate-500">15 Mar 2025</time>
                <h2 class="font-semibold text-slate-900 mt-1">CTC fellowship intake 2025</h2>
                <p class="text-sm text-slate-600 mt-1">Applications are open for the Cardiothoracic Surgery Fellowship programme.</p>
            </article>
            <article class="p-4 border border-slate-200 rounded-lg">
                <time class="text-sm text-slate-500">10 Mar 2025</time>
                <h2 class="font-semibold text-slate-900 mt-1">New cardiac ICU expansion</h2>
                <p class="text-sm text-slate-600 mt-1">Our Cardiac ICU has been expanded to serve more critically ill patients.</p>
            </article>
        </div>
    </x-page>
@endsection
