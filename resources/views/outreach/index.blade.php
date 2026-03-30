@extends('layouts.app')

@section('title', 'Outreach Programs')

@section('content')
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-18">
            <nav class="text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-[var(--brand-primary)]">Home</a>
                <span class="mx-2">/</span>
                <span class="text-slate-700">Outreach Programs</span>
            </nav>
            <div class="mt-8 grid gap-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-end">
                <div class="max-w-3xl">
                    <div class="brand-text text-xs font-semibold uppercase tracking-[0.25em]">Outreach Programs</div>
                    <h1 class="mt-4 font-serif text-4xl leading-tight text-slate-950 sm:text-5xl">A clearer public home for community-facing work.</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">The previous “Community &amp; Mission” label was too broad. Outreach Programs is more precise, and it gives Community Health &amp; Development a proper place in the navigation structure.</p>
                </div>
                <div class="accent-bg-soft rounded-[2rem] p-7 ring-1 accent-border">
                    <div class="accent-text text-sm font-semibold uppercase tracking-[0.2em]">Sub-menu</div>
                    <a href="{{ route('outreach.community-health-development') }}" class="mt-4 block rounded-2xl bg-white px-5 py-4 text-slate-900 shadow-sm ring-1 accent-border hover:ring-[var(--brand-primary)]/20">Community Health &amp; Development</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-stone-50 py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-7 shadow-sm ring-1 ring-stone-200">
                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Why Rename It</div>
                    <p class="mt-4 text-sm leading-7 text-slate-600">The new label reflects operational work more clearly and improves scanability in the main navigation.</p>
                </div>
                <div class="rounded-[2rem] bg-white p-7 shadow-sm ring-1 ring-stone-200">
                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">What It Can Hold</div>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Future content can include community health initiatives, satellite work, partnerships, and programme impact summaries.</p>
                </div>
                <div class="brand-bg rounded-[2rem] p-7 text-white">
                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-200">Current Visible Child</div>
                    <p class="mt-4 text-sm leading-7 text-slate-300">Community Health &amp; Development is promoted as the first explicit submenu item in this section.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
