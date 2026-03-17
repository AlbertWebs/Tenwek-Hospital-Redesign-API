@foreach($items as $item)
    @php $id = $item['id']; $children = $item['children'] ?? []; @endphp
    <div class="menu-item-row flex items-center gap-2 rounded-xl border border-slate-100 bg-white px-3 py-2.5 group hover:border-slate-200 hover:bg-slate-50/50"
         data-id="{{ $id }}">
        <span class="drag-handle cursor-grab touch-none rounded p-1.5 text-slate-400 hover:bg-slate-200 hover:text-slate-600 active:cursor-grabbing" title="Drag to reorder">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h2zM15 2a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2V4a2 2 0 012-2h2zM5 4v12h2V4H5zm8 0v12h2V4h-2z"/></svg>
        </span>
        <span class="min-w-0 flex-1 font-medium text-slate-800 truncate">{{ $item['label'] ?? 'Untitled' }}</span>
        <span class="hidden shrink-0 text-slate-400 text-xs sm:inline truncate max-w-[120px]" title="{{ $item['url'] ?? $item['route'] ?? ($item['page']['slug'] ?? '') }}">{{ $item['url'] ?: ($item['route'] ?? ($item['page']['slug'] ?? '—')) }}</span>
        <div class="flex shrink-0 items-center gap-0.5 opacity-0 group-hover:opacity-100 transition">
            <a href="{{ route('admin.menus.index', ['menu' => $currentMenu->location ?? $currentMenu->key]) }}?edit={{ $id }}" class="rounded-lg p-2 text-slate-400 hover:bg-slate-200 hover:text-slate-600" title="Edit">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </a>
            <form action="{{ route('admin.menus.items.duplicate', $id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-slate-200 hover:text-slate-600" title="Duplicate"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></button>
            </form>
            <form action="{{ route('admin.menus.items.destroy', $id) }}" method="POST" class="inline" onsubmit="return confirm('Remove this menu item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-red-100 hover:text-red-600" title="Delete"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
            </form>
        </div>
        @if(!empty($children))
            <div class="menu-children w-full ml-8 mt-1 space-y-1 border-l-2 border-slate-100 pl-3">
                @include('admin.menus.partials.tree', ['items' => $children, 'currentMenu' => $currentMenu])
            </div>
        @endif
    </div>
@endforeach
