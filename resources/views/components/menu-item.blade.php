@php
    $item = $item ?? null;
    $location = $location ?? 'header';
    $children = $item->children->filter(fn ($c) => $c->is_visible);
    $hasChildren = $children->isNotEmpty();
    $href = $item->page_id && $item->relationLoaded('page') && $item->page
        ? ($item->page->slug === 'home' ? url('/') : url('/' . $item->page->slug))
        : ($item->route && \Illuminate\Support\Facades\Route::has($item->route) ? route($item->route) : ($item->url ?? '#'));
    $target = $item->open_in_new_tab ? '_blank' : '_self';
@endphp
@if($hasChildren && $location === 'header')
    <li class="{{ $itemClass }} relative group/list">
        <button type="button" class="{{ $linkClass }} inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded"
                aria-expanded="false" aria-haspopup="true">
            {{ $item->label }}
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <ul class="absolute left-0 top-full pt-1 w-56 opacity-0 invisible group-hover/list:opacity-100 group-hover/list:visible transition-all duration-200 {{ $dropdownClass }}">
            <li class="bg-white rounded-lg shadow-lg border border-slate-200 py-2">
                @foreach($children as $child)
                    @include('components.menu-item', ['item' => $child, 'location' => $location, 'itemClass' => '', 'linkClass' => 'block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50', 'dropdownClass' => ''])
                @endforeach
            </li>
        </ul>
    </li>
@elseif($hasChildren && $location === 'footer')
    <li class="{{ $itemClass }}">
        <span class="text-xs font-semibold text-white uppercase tracking-wider">{{ $item->label }}</span>
        <ul class="mt-2 space-y-1">
            @foreach($children as $child)
                @include('components.menu-item', ['item' => $child, 'location' => $location, 'itemClass' => '', 'linkClass' => 'hover:text-white', 'dropdownClass' => ''])
            @endforeach
        </ul>
    </li>
@else
    <li class="{{ $itemClass }}">
        <a href="{{ $href }}" target="{{ $target }}" {{ $target === '_blank' ? 'rel="noopener noreferrer"' : '' }} class="{{ $linkClass }} {{ $location === 'header' ? 'px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded' : 'hover:text-white' }}">
            {{ $item->label }}
        </a>
    </li>
@endif
