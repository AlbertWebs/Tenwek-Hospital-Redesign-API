@props(['striped' => true])

<div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-slate-200']) }}>
            <thead class="bg-slate-50/80">
                {{ $head }}
            </thead>
            <tbody class="divide-y divide-slate-100 {{ $striped ? 'divide-y divide-slate-100' : '' }}">
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
