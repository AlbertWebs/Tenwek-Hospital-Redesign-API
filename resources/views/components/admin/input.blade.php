@props(['label' => null, 'name', 'type' => 'text', 'error' => null, 'hint' => null])

<div class="space-y-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>
    @endif
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ $attributes->merge(['class' => 'block w-full rounded-xl border-slate-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-slate-900 placeholder:text-slate-400 sm:text-sm' . ($error ? ' border-red-500' : '')]) }}
    />
    @if($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
    @if($hint)
        <p class="text-sm text-slate-500">{{ $hint }}</p>
    @endif
</div>
