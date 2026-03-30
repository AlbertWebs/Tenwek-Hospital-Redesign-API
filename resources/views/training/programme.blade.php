@extends('layouts.app')

@section('title', $title)

@section('content')
    <x-page :title="$title" :breadcrumbs="$breadcrumbs ?? []">
        <p>{{ $intro }}</p>

        @if (!empty($cards ?? []))
            <div class="not-prose mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($cards as $card)
                    @if (isset($card['url']))
                        <a href="{{ $card['url'] }}" class="block rounded-3xl border border-stone-200 bg-white p-6 transition hover:border-[var(--brand-primary)] hover:bg-stone-50">
                            <h2 class="text-xl font-semibold text-slate-950">{{ $card['title'] }}</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $card['description'] }}</p>
                        </a>
                    @else
                        <div class="block rounded-3xl border border-stone-200 bg-white p-6">
                            <h2 class="text-xl font-semibold text-slate-950">{{ $card['title'] }}</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $card['description'] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </x-page>
@endsection
