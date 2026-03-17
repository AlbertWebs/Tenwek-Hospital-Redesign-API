@props(['items' => []])

<nav class="mb-6 flex text-sm text-slate-500" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2">
        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-teal-600 transition">Dashboard</a></li>
        @foreach($items as $label => $url)
            <li class="flex items-center gap-2">
                <svg class="h-4 w-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                @if($url)
                    <a href="{{ $url }}" class="hover:text-teal-600 transition">{{ $label }}</a>
                @else
                    <span class="text-slate-800 font-medium">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
