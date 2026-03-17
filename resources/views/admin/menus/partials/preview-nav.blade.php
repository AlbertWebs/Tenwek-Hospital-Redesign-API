@php
    $style = $style ?? 'header';
@endphp
@if($style === 'header')
    <nav class="flex flex-wrap items-center gap-1">
        @foreach($tree as $item)
            @if(!empty($item['children']))
                <div class="relative group">
                    <span class="cursor-default px-2 py-1 text-slate-700 rounded hover:bg-slate-100">{{ $item['label'] ?? 'Item' }}</span>
                    <div class="absolute left-0 top-full pt-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
                        <div class="bg-white border border-slate-200 rounded-lg shadow py-1 min-w-[140px]">
                            @foreach($item['children'] as $child)
                                <a href="#" class="block px-3 py-1.5 text-sm text-slate-700 hover:bg-slate-50">{{ $child['label'] ?? 'Sub' }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <a href="#" class="px-2 py-1 text-slate-700 rounded hover:bg-slate-100">{{ $item['label'] ?? 'Item' }}</a>
            @endif
        @endforeach
    </nav>
@else
    <div class="flex flex-wrap gap-x-4 gap-y-1">
        @foreach($tree as $item)
            <a href="#" class="hover:text-white">{{ $item['label'] ?? 'Item' }}</a>
        @endforeach
    </div>
@endif
@if(empty($tree))
    <span class="text-slate-400 text-sm">No items</span>
@endif
