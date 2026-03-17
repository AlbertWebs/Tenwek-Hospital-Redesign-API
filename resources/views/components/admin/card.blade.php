@props(['padding' => true, 'rounded' => '2xl'])

<div {{ $attributes->merge(['class' => 'admin-card bg-white border border-slate-200/80 overflow-hidden rounded-2xl']) }}>
    @if(isset($header))
        <div class="border-b border-slate-100 px-6 py-4">
            {{ $header }}
        </div>
    @endif
    <div @class(['p-6' => $padding])>
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="border-t border-slate-100 bg-slate-50/50 px-6 py-4">
            {{ $footer }}
        </div>
    @endif
</div>
