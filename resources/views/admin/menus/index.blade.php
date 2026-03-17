@extends('admin.layouts.app')

@section('title', 'Menu Management')

@push('styles')
<style>
    .menu-sortable .sortable-ghost { opacity: 0.4; background: #e2e8f0; border-radius: 0.5rem; }
    .menu-sortable .sortable-drag { opacity: 1; }
    .menu-item-row { transition: background 0.15s ease; }
</style>
@endpush

@section('content')
    <x-admin.breadcrumb :items="['Menu Management' => null]" />

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Menu Management</h1>
            <p class="mt-1 text-slate-600">Build header and footer navigation. Drag to reorder, click to edit.</p>
        </div>
    </div>

    <div class="flex flex-col gap-6 lg:flex-row" x-data="menuBuilder()"
         data-store-url="{{ route('admin.menus.items.store') }}"
         data-update-url="{{ url('admin/menus/items') }}"
         data-reorder-url="{{ route('admin.menus.reorder') }}"
         data-csrf="{{ csrf_token() }}"
         data-menu-id="{{ $currentMenu->id }}">
        {{-- Sidebar: Menu type --}}
        <aside class="w-full lg:w-56 shrink-0">
            <x-admin.card class="sticky top-24">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-3">Menus</h2>
                <nav class="space-y-1">
                    @foreach($menus as $menu)
                        <a href="{{ route('admin.menus.index', ['menu' => $menu->location ?? $menu->key]) }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ ($currentMenu->id ?? null) === $menu->id ? 'bg-violet-100 text-violet-800' : 'text-slate-600 hover:bg-slate-100' }}">
                            @if(($menu->location ?? $menu->key) === 'header')
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            @else
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            @endif
                            {{ $menu->name }}
                        </a>
                    @endforeach
                </nav>
            </x-admin.card>
        </aside>

        <div class="flex-1 min-w-0 space-y-6">
            {{-- Toolbar --}}
            <x-admin.card>
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h2 class="text-lg font-semibold text-slate-900">{{ $currentMenu->name }}</h2>
                    <div class="flex items-center gap-2">
                        <button type="button" x-on:click="$dispatch('open-add-menu')"
                                class="inline-flex items-center gap-2 rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-violet-700 transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Add item
                        </button>
                        <button type="button" @click="saveOrder()" :disabled="saving"
                                class="inline-flex items-center gap-2 rounded-xl border border-violet-300 bg-violet-50 px-4 py-2.5 text-sm font-medium text-violet-700 hover:bg-violet-100 transition disabled:opacity-50">
                            <span x-show="!saving">Save order</span>
                            <span x-show="saving" x-cloak>Saving…</span>
                        </button>
                    </div>
                </div>
            </x-admin.card>

            {{-- Menu items list (nested, sortable) --}}
            <x-admin.card>
                <div id="menu-list" class="space-y-1">
                    @include('admin.menus.partials.tree', ['items' => $tree, 'currentMenu' => $currentMenu])
                </div>
                @if(empty($tree))
                    <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-12 text-center">
                        <p class="text-slate-500">No menu items yet.</p>
                        <button type="button" @click="$dispatch('open-add-menu')" class="mt-3 text-sm font-medium text-violet-600 hover:text-violet-700">Add your first item</button>
                    </div>
                @endif
            </x-admin.card>

            {{-- Sticky save bar --}}
            <div class="sticky bottom-4 z-30 flex justify-end">
                <button type="button" @click="saveOrder()" :disabled="saving"
                        class="rounded-xl bg-violet-600 px-5 py-3 text-sm font-medium text-white shadow-lg hover:bg-violet-700 transition disabled:opacity-50">
                    <span x-show="!saving">Save changes</span>
                    <span x-show="saving" x-cloak>Saving…</span>
                </button>
            </div>

            {{-- Live preview --}}
            <x-admin.card>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-3">Preview</h3>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium text-slate-400 mb-2">Header</p>
                        <div id="preview-header" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                            @include('admin.menus.partials.preview-nav', ['tree' => $tree, 'style' => 'header'])
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 mb-2">Footer</p>
                        <div id="preview-footer" class="rounded-xl border border-slate-200 bg-slate-800 px-4 py-3 text-sm text-slate-300">
                            @include('admin.menus.partials.preview-nav', ['tree' => $tree, 'style' => 'footer'])
                        </div>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>

    {{-- Add item modal --}}
    @include('admin.menus.partials.add-modal', ['currentMenu' => $currentMenu, 'pages' => $pages])

    {{-- Edit slide-over --}}
    @include('admin.menus.partials.edit-panel', ['pages' => $pages])

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        document.addEventListener('alpine:init', function() {
            Alpine.data('menuBuilder', function() {
                const el = this.$el;
                const menuId = parseInt(el.dataset.menuId || '0', 10);
                return {
                    addOpen: false,
                    editOpen: false,
                    editItem: null,
                    saving: false,
                    get storeUrl() { return el.dataset.storeUrl || ''; },
                    get updateUrl() { return el.dataset.updateUrl || ''; },
                    get reorderUrl() { return el.dataset.reorderUrl || ''; },
                    get csrf() { return el.dataset.csrf || ''; },
                    init() {
                        this.$nextTick(() => this.initSortable());
                    },
                    initSortable() {
                        const list = document.getElementById('menu-list');
                        if (!list || typeof Sortable === 'undefined') return;
                        const opts = {
                            animation: 200,
                            handle: '.drag-handle',
                            ghostClass: 'sortable-ghost',
                            dragClass: 'sortable-drag',
                            group: 'menu',
                            fallbackOnBody: true,
                            swapThreshold: 0.65
                        };
                        new Sortable(list, opts);
                        list.querySelectorAll('.menu-children').forEach(function(el) {
                            new Sortable(el, opts);
                        });
                    },
                    saveOrder() {
                        const order = this.getOrderFromDom();
                        if (!order.length) return;
                        this.saving = true;
                        fetch(this.reorderUrl, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                            body: JSON.stringify({ menu_id: menuId, order: order })
                        }).then(r => r.json()).then(() => {
                            this.saving = false;
                            window.location.reload();
                        }).catch(() => { this.saving = false; });
                    },
                    getOrderFromDom() {
                        const list = document.getElementById('menu-list');
                        if (!list) return [];
                        return Array.from(list.children).filter(el => el.dataset && el.dataset.id).map(el => this.collectItem(el));
                    },
                    collectItem(el) {
                        const id = parseInt(el.dataset.id, 10);
                        const childList = el.querySelector(':scope > .menu-children');
                        const result = { id };
                        if (childList) {
                            result.children = Array.from(childList.children).filter(c => c.dataset && c.dataset.id).map(c => this.collectItem(c));
                        }
                        return result;
                    }
                };
            });
        });
    </script>
    @endpush
@endsection
