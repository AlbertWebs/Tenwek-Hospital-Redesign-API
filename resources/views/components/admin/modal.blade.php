@props(['name' => 'modal', 'title' => null, 'maxWidth' => 'lg'])

<div x-data="{ open: false }"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
             @click="open = false">
        </div>
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @class([
                'relative w-full rounded-2xl bg-white shadow-xl',
                'max-w-lg' => $maxWidth === 'lg',
                'max-w-md' => $maxWidth === 'md',
                'max-w-2xl' => $maxWidth === '2xl',
             ])>
            @if($title)
                <div class="border-b border-slate-100 px-6 py-4">
                    <h3 id="modal-title" class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
                </div>
            @endif
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
