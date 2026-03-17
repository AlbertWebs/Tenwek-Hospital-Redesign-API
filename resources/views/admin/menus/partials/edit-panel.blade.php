@php
    $editItem = $editItem ?? null;
@endphp
@if($editItem)
<div x-data="{ open: true }"
     x-show="open"
     x-cloak
     class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-white shadow-xl border-l border-slate-200"
     aria-labelledby="edit-panel-title"
     role="dialog"
     aria-modal="true">
    <div class="flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
            <h2 id="edit-panel-title" class="text-lg font-semibold text-slate-900">Edit menu item</h2>
            <a href="{{ route('admin.menus.index', ['menu' => $editItem->menu->location ?? $editItem->menu->key]) }}" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
        </div>
        <div class="flex-1 overflow-y-auto px-6 py-4">
            <form action="{{ route('admin.menus.items.update', $editItem) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_label" class="block text-sm font-medium text-slate-700">Label</label>
                    <input type="text" name="label" id="edit_label" value="{{ old('label', $editItem->label) }}" required
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500" />
                </div>
                <div>
                    <label for="edit_page_id" class="block text-sm font-medium text-slate-700">Page (optional)</label>
                    <select name="page_id" id="edit_page_id" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500">
                        <option value="">— None (use URL below) —</option>
                        @foreach($pages as $p)
                            <option value="{{ $p->id }}" {{ (int) $editItem->page_id === (int) $p->id ? 'selected' : '' }}>{{ $p->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="edit_url" class="block text-sm font-medium text-slate-700">URL (if no page)</label>
                    <input type="text" name="url" id="edit_url" value="{{ old('url', $editItem->url) }}"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500"
                           placeholder="/path or https://..." />
                </div>
                <div>
                    <label for="edit_icon" class="block text-sm font-medium text-slate-700">Icon (class or name)</label>
                    <input type="text" name="icon" id="edit_icon" value="{{ old('icon', $editItem->icon) }}"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500"
                           placeholder="optional" />
                </div>
                <div>
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="open_in_new_tab" value="1" {{ $editItem->open_in_new_tab ? 'checked' : '' }} class="rounded border-slate-300 text-violet-600 focus:ring-violet-500" />
                        <span class="text-sm text-slate-700">Open in new tab</span>
                    </label>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-violet-700">Save</button>
                    <a href="{{ route('admin.menus.index', ['menu' => $editItem->menu->location ?? $editItem->menu->key]) }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="fixed inset-0 z-40 bg-slate-900/30" aria-hidden="true"></div>
@endif
