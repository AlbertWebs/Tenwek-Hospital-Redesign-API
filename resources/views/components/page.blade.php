@props(['title', 'breadcrumbs' => []])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
    @if(count($breadcrumbs) > 0)
        <nav class="text-sm text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-teal-600">Home</a>
            @foreach($breadcrumbs as $label => $url)
                <span class="mx-1">/</span>
                @if($url)
                    <a href="{{ $url }}" class="hover:text-teal-600">{{ $label }}</a>
                @else
                    <span class="text-slate-700">{{ $label }}</span>
                @endif
            @endforeach
        </nav>
    @endif
    <h1 class="text-3xl font-bold text-slate-900">{{ $title }}</h1>
    <div class="mt-6 prose prose-slate max-w-none">
        {{ $slot }}
    </div>
</div>
