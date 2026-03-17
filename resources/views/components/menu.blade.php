@php
    $menu = $this->menu();
@endphp
@if($menu)
    @php
        $items = $menu->items()->with(['children' => fn ($q) => $q->where('is_visible', true)->orderBy('order')->with('page'), 'page'])->get();
    @endphp
    <nav class="{{ $class }}" aria-label="{{ $location === 'header' ? 'Main' : 'Footer' }} navigation">
        <ul class="{{ $ulClass }} {{ $location === 'header' ? 'flex flex-wrap items-center gap-1' : 'space-y-2' }}">
            @foreach($items as $item)
                @if(!$item->is_visible) @continue @endif
                @include('components.menu-item', [
                    'item' => $item,
                    'location' => $location,
                    'itemClass' => $itemClass,
                    'linkClass' => $linkClass,
                    'dropdownClass' => $dropdownClass,
                ])
            @endforeach
        </ul>
    </nav>
@endif
