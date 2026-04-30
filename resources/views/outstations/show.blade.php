@extends('layouts.app')

@section('title', $outstation->name)

@push('styles')
    @if($outstation->hasMapCoordinates())
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    @endif
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
    <nav class="text-sm text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-teal-600">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('outstations.index') }}" class="hover:text-teal-600">Outstations</a>
        <span class="mx-1">/</span>
        <span class="text-slate-700">{{ $outstation->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-3 lg:gap-12">
        <div class="lg:col-span-2">
            <h1 class="text-3xl font-bold text-slate-900">{{ $outstation->name }}</h1>
            @if($outstation->summary)
                <p class="mt-4 text-lg text-slate-600">{{ $outstation->summary }}</p>
            @endif

            @if($outstation->hasMapCoordinates())
                <div class="mt-10 not-prose rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <div id="outstation-map" class="w-full h-[280px] sm:h-[360px]" aria-label="Map showing {{ $outstation->name }}"></div>
                </div>
            @endif

            @if($outstation->content)
                <div class="mt-10 prose prose-slate max-w-none">
                    {!! $outstation->content !!}
                </div>
            @endif
        </div>

        <aside class="mt-12 lg:mt-0 lg:col-span-1">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 space-y-6">
                <div>
                    <h2 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Location</h2>
                    @if($outstation->address)
                        <p class="mt-2 text-slate-800 whitespace-pre-line">{{ $outstation->address }}</p>
                    @else
                        <p class="mt-2 text-slate-500">Address to be confirmed.</p>
                    @endif
                    @if($outstation->hasMapCoordinates())
                        <a href="https://www.openstreetmap.org/?mlat={{ $outstation->latitude }}&mlon={{ $outstation->longitude }}#map=15/{{ $outstation->latitude }}/{{ $outstation->longitude }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Open in maps ↗</a>
                    @endif
                </div>
                @if($outstation->phone || $outstation->email)
                    <div>
                        <h2 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Contact</h2>
                        @if($outstation->phone)
                            <p class="mt-2"><a href="tel:{{ preg_replace('/\s+/', '', $outstation->phone) }}" class="font-medium text-teal-600 hover:text-teal-700">{{ $outstation->phone }}</a></p>
                        @endif
                        @if($outstation->email)
                            <p class="mt-1"><a href="mailto:{{ $outstation->email }}" class="font-medium text-teal-600 hover:text-teal-700">{{ $outstation->email }}</a></p>
                        @endif
                    </div>
                @endif
            </div>

            @if($outstationsNav->isNotEmpty())
                <div class="mt-8">
                    <h2 class="text-sm font-semibold text-slate-900">Other outstations</h2>
                    <ul class="mt-3 space-y-2 text-sm">
                        @foreach($outstationsNav as $o)
                            <li><a href="{{ route('outstations.show', $o) }}" class="text-teal-600 hover:text-teal-800">{{ $o->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection

@push('scripts')
    @if($outstation->hasMapCoordinates())
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            (function () {
                var lat = {{ json_encode((float) $outstation->latitude) }};
                var lng = {{ json_encode((float) $outstation->longitude) }};
                var map = L.map('outstation-map').setView([lat, lng], 14);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                L.marker([lat, lng]).addTo(map).bindPopup(@json($outstation->name)).openPopup();
            })();
        </script>
    @endif
@endpush
