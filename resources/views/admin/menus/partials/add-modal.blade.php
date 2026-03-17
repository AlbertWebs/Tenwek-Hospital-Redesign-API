@php $menu = $currentMenu ?? null; @endphp
<div x-data="{ open: false, linkType: 'custom' }"
     x-show="open"
     x-on:open-add-menu.window="open = true"
     x-on:keydown.escape.window="open = false"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="add-item-title"
     role="dialog"
     aria-modal="true"
     style="display: none;">
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open" x-transition class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="open = false"></div>
        <div x-show="open" x-transition class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl">
            <h3 id="add-item-title" class="text-lg font-semibold text-slate-900">Add menu item</h3>
            <form action="{{ route('admin.menus.items.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id ?? '' }}" />
                <input type="hidden" name="parent_id" value="" />

                <div>
                    <label class="block text-sm font-medium text-slate-700">Link type</label>
                    <div class="mt-1.5 flex gap-4">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="link_type" value="custom" checked class="rounded border-slate-300 text-violet-600 focus:ring-violet-500" x-model="linkType" />
                            <span class="text-sm">Custom URL</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="link_type" value="page" class="rounded border-slate-300 text-violet-600 focus:ring-violet-500" x-model="linkType" />
                            <span class="text-sm">From page</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="link_type" value="external" class="rounded border-slate-300 text-violet-600 focus:ring-violet-500" x-model="linkType" />
                            <span class="text-sm">External</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="add_label" class="block text-sm font-medium text-slate-700">Label</label>
                    <input type="text" name="label" id="add_label" required
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500"
                           placeholder="e.g. Home" />
                </div>

                <div x-show="linkType === 'page'">
                    <label for="add_page_id" class="block text-sm font-medium text-slate-700">Page (sets link; label above is used)</label>
                    <select name="page_id" id="add_page_id" class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500">
                        <option value="">— Select page —</option>
                        @foreach($pages as $p)
                            <option value="{{ $p->id }}">{{ $p->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div x-show="linkType === 'custom' || linkType === 'external'">
                    <label for="add_url" class="block text-sm font-medium text-slate-700">URL</label>
                    <input type="text" name="url" id="add_url"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-violet-500 focus:ring-violet-500"
                           placeholder="/path or https://..." />
                </div>

                <div>
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="open_in_new_tab" value="1" class="rounded border-slate-300 text-violet-600 focus:ring-violet-500" />
                        <span class="text-sm text-slate-700">Open in new tab</span>
                    </label>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="open = false" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
                    <button type="submit" class="rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-violet-700">Add item</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#add-item-title')?.closest('.relative')?.querySelector('form');
    if (form) {
        form.querySelector('#add_page_id')?.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            const labelInput = form.querySelector('#add_label');
            if (labelInput && opt && opt.value) labelInput.value = opt.text.trim();
        });
    }
});
</script>
