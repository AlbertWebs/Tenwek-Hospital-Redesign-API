@extends('layouts.app')

@section('title', 'Outstations')

@push('styles')
    @if($markers->isNotEmpty())
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    @endif
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
    <nav class="text-sm text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-teal-600">Home</a>
        <span class="mx-1">/</span>
        <span class="text-slate-700">Outstations</span>
    </nav>
    <h1 class="text-3xl font-bold text-slate-900">Tenwek Hospital Outstations</h1>
    <p class="mt-4 text-lg text-slate-600 max-w-3xl">Satellite facilities and outreach centres bring care closer to communities across the region. Explore each location below and on the map.</p>

    @if($outstations->isEmpty())
        <p class="mt-10 text-slate-500">Outstation information will be published here soon.</p>
    @else
        @if($markers->isNotEmpty())
            <div class="mt-10 not-prose rounded-2xl border border-slate-200 overflow-hidden shadow-sm bg-white">
                <div id="outstations-map" class="w-full h-[320px] sm:h-[420px]" aria-label="Map of outstation locations"></div>
            </div>
        @endif

        <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($outstations as $os)
                <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:border-teal-200 hover:shadow-md transition flex flex-col">
                    <h2 class="text-xl font-semibold text-slate-900">
                        <a href="{{ route('outstations.show', $os) }}" class="hover:text-teal-700">{{ $os->name }}</a>
                    </h2>
                    @if($os->summary)
                        <p class="mt-3 text-slate-600 text-sm leading-relaxed flex-1">{{ $os->summary }}</p>
                    @endif
                    @if($os->address)
                        <p class="mt-4 text-sm text-slate-500">{{ $os->address }}</p>
                    @endif
                    <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap gap-3 text-sm">
                        @if($os->phone)
                            <a href="tel:{{ preg_replace('/\s+/', '', $os->phone) }}" class="font-medium text-teal-600 hover:text-teal-700">{{ $os->phone }}</a>
                        @endif
                        @if($os->email)
                            <a href="mailto:{{ $os->email }}" class="font-medium text-teal-600 hover:text-teal-700">{{ $os->email }}</a>
                        @endif
                    </div>
                    <a href="{{ route('outstations.show', $os) }}" class="mt-5 inline-flex items-center text-sm font-semibold text-teal-700 hover:text-teal-800">View details →</a>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
    @if($markers->isNotEmpty())
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            (function () {
                var markers = @json($markers);
                var map = L.map('outstations-map');
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                var bounds = [];
                markers.forEach(function (m) {
                    var marker = L.marker([m.lat, m.lng]).addTo(map).bindPopup('<a class="font-semibold text-teal-700" href="' + m.url + '">' + m.name.replace(/</g, '&lt;') + '</a>');
                    bounds.push([m.lat, m.lng]);
                });
                if (bounds.length === 1) {
                    map.setView(bounds[0], 10);
                } else {
                    map.fitBounds(bounds, { padding: [40, 40], maxZoom: 12 });
                }
            })();
        </script>
    @endif
@endpush
