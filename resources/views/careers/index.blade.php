@extends('layouts.app')
@section('title', 'Careers')
@section('content')
    <x-page title="Careers" :breadcrumbs="['Careers' => null]">
        <p>Work at Tenwek Hospital. View open positions and opportunities below.</p>

        <section id="positions" class="mt-10 not-prose">
            <h2 class="text-xl font-semibold text-slate-900">Open positions</h2>
            @if($jobs->isEmpty())
                <p class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-6 text-slate-600">There are no open positions at the moment. Please check back later or contact us for internship and volunteer opportunities.</p>
            @else
                <ul class="mt-4 space-y-4">
                    @foreach($jobs as $job)
                        <li id="job-{{ $job->id }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-teal-200 hover:shadow-md">
                            <h3 class="font-semibold text-slate-900">{{ $job->title }}</h3>
                            <div class="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-sm text-slate-500">
                                @if($job->department)<span>{{ $job->department }}</span>@endif
                                @if($job->employment_type)<span>{{ $job->employment_type }}</span>@endif
                                @if($job->location)<span>{{ $job->location }}</span>@endif
                            </div>
                            @if($job->closing_date)
                                <p class="mt-1 text-xs text-slate-500">Closes {{ $job->closing_date->format('F j, Y') }}</p>
                            @endif
                            @if($job->description)
                                <div class="mt-3 text-slate-600 prose prose-slate max-w-none prose-p:my-2">{!! nl2br(e($job->description)) !!}</div>
                            @endif
                            @if($job->requirements)
                                <p class="mt-3 text-sm font-medium text-slate-700">Requirements</p>
                                <div class="mt-1 text-slate-600 prose prose-slate max-w-none text-sm">{!! nl2br(e($job->requirements)) !!}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section id="internships" class="mt-12 not-prose">
            <h2 class="text-xl font-semibold text-slate-900">Internship & volunteer opportunities</h2>
            <p class="mt-3 text-slate-600">For internship programmes and volunteering, please see our <a href="{{ route('training.index') }}" class="text-teal-600 hover:text-teal-700">Training</a> and <a href="{{ route('volunteers') }}" class="text-teal-600 hover:text-teal-700">Volunteers</a> pages, or contact us.</p>
        </section>
    </x-page>
@endsection
