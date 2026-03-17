@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button', 'href' => null])

@php
    $base = 'inline-flex items-center justify-center font-medium rounded-xl transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    $variants = [
        'primary' => 'bg-teal-600 text-white shadow-sm hover:bg-teal-700 focus:ring-teal-500',
        'secondary' => 'bg-slate-100 text-slate-800 hover:bg-slate-200 focus:ring-slate-400',
        'outline' => 'border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 focus:ring-teal-500',
        'ghost' => 'text-slate-600 hover:bg-slate-100 focus:ring-slate-400',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2.5 text-sm gap-2',
        'lg' => 'px-5 py-3 text-base gap-2',
    ];
    $class = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
