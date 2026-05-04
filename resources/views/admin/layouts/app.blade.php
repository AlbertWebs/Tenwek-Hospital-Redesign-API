<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Tenwek Admin</title>
    <script>
        (function() {
            var stored = localStorage.getItem('admin-dark');
            if (stored === 'true') document.documentElement.classList.add('dark');
        })();
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>tailwind.config = { darkMode: 'class' }</script>
    @endif
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: width 0.2s ease, padding 0.2s ease; }
        .admin-card { border-radius: 1rem; box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05), 0 1px 2px -1px rgb(0 0 0 / 0.05); }
        .dark .admin-card { box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.2); }
        body { font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .font-sans { font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 dark:bg-slate-900 font-sans antialiased text-slate-800 dark:text-slate-200"
      x-data="{ sidebarOpen: true, dark: localStorage.getItem('admin-dark') === 'true' }"
      x-init="$watch('dark', v => { localStorage.setItem('admin-dark', v); document.documentElement.classList.toggle('dark', v) }); document.documentElement.classList.toggle('dark', dark)">
    <div class="flex min-h-screen">
        {{-- Sidebar (always dark) --}}
        <aside
            class="sidebar-transition fixed inset-y-0 left-0 z-40 flex flex-col border-r border-slate-700/80 bg-gradient-to-b from-slate-800 to-slate-900"
            :class="sidebarOpen ? 'w-64' : 'w-20'"
        >
            <div class="flex h-16 shrink-0 items-center border-b border-slate-700/80 bg-slate-800/90 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-teal-500 text-white font-semibold shadow-sm ring-2 ring-teal-400/30">T</div>
                    <span x-show="sidebarOpen" x-cloak class="text-lg font-semibold text-white truncate">Tenwek Admin</span>
                </a>
            </div>
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <ul class="space-y-0.5">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'border-l-2 border-teal-400 bg-teal-500/20 text-teal-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-teal-500 text-white' : 'bg-slate-700/60 text-teal-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Dashboard</span>
                        </a>
                    </li>
                </ul>

                <p x-show="sidebarOpen" x-cloak class="mt-6 flex items-center gap-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400"><span class="h-px flex-1 bg-slate-600"></span>Pages<span class="h-px w-6 bg-slate-600"></span></p>
                <ul class="mt-1 space-y-0.5">
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.pages.index') ? 'border-l-2 border-teal-400 bg-teal-500/20 text-teal-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.pages.index') ? 'bg-teal-500 text-white' : 'bg-slate-700/60 text-teal-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>All Pages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.create') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.pages.create') ? 'border-l-2 border-teal-400 bg-teal-500/20 text-teal-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.pages.create') ? 'bg-teal-500 text-white' : 'bg-slate-700/60 text-teal-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Add Page</span>
                        </a>
                    </li>
                </ul>

                <p x-show="sidebarOpen" x-cloak class="mt-6 flex items-center gap-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400"><span class="h-px flex-1 bg-slate-600"></span>Content<span class="h-px w-6 bg-slate-600"></span></p>
                <ul class="mt-1 space-y-0.5">
                    <li>
                        <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.media.*') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.media.*') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6 6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Media Library</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.carousels.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.carousels.index', 'admin.carousels.edit') || request()->routeIs('admin.carousels.slides.*') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.carousels.index', 'admin.carousels.edit') || request()->routeIs('admin.carousels.slides.*') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Carousels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.carousels.create') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.carousels.create') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.carousels.create') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Add carousel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.posts.*') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.posts.*') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16v6m3-3v3m0-3v-3m0 3v-3m0-3v3"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>News & Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.careers.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.careers.*') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.careers.*') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Careers (Jobs)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.outstations.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.outstations.*') ? 'border-l-2 border-amber-400 bg-amber-500/20 text-amber-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.outstations.*') ? 'bg-amber-500 text-white' : 'bg-slate-700/60 text-amber-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Outstations</span>
                        </a>
                    </li>
                </ul>

                <p x-show="sidebarOpen" x-cloak class="mt-6 flex items-center gap-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400"><span class="h-px flex-1 bg-slate-600"></span>CTC<span class="h-px w-6 bg-slate-600"></span></p>
                <ul class="mt-1 space-y-0.5">
                    <li>
                        <a href="{{ route('admin.ctc.services.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.ctc.services.*') ? 'border-l-2 border-rose-400 bg-rose-500/20 text-rose-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.ctc.services.*') ? 'bg-rose-500 text-white' : 'bg-slate-700/60 text-rose-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Cardiac Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ctc.clinics.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-700/60 hover:text-white">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-700/60 text-rose-300"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Clinics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ctc.facilities.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-700/60 hover:text-white">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-700/60 text-rose-300"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Facilities</span>
                        </a>
                    </li>
                </ul>

                <p x-show="sidebarOpen" x-cloak class="mt-6 flex items-center gap-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400"><span class="h-px flex-1 bg-slate-600"></span>System<span class="h-px w-6 bg-slate-600"></span></p>
                <ul class="mt-1 space-y-0.5">
                    <li>
                        <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.menus.*') ? 'border-l-2 border-violet-400 bg-violet-500/20 text-violet-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.menus.*') ? 'bg-violet-500 text-white' : 'bg-slate-700/60 text-violet-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Menu Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'border-l-2 border-violet-400 bg-violet-500/20 text-violet-100 -ml-px pl-[11px]' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-violet-500 text-white' : 'bg-slate-700/60 text-violet-300' }}"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                            <span x-show="sidebarOpen" x-cloak>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="border-t border-slate-700/80 bg-slate-800/90 p-3 space-y-1">
                <form method="POST" action="{{ route('admin.logout') }}" class="block">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition-colors hover:bg-slate-700/60 hover:text-red-400">
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span x-show="sidebarOpen" x-cloak>Sign out</span>
                    </button>
                </form>
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="flex w-full items-center justify-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition-colors hover:bg-slate-700/60 hover:text-white">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="sidebarOpen ? '' : 'rotate-180'"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Collapse</span>
                </button>
            </div>
        </aside>

        <div class="flex flex-1 flex-col transition-all duration-200" :class="sidebarOpen ? 'pl-64' : 'pl-20'">
            {{-- Header --}}
            <header class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-4 border-b border-slate-200/80 dark:border-slate-700/80 bg-white/95 dark:bg-slate-800/95 px-6 backdrop-blur supports-[backdrop-filter]:bg-white/80 dark:supports-[backdrop-filter]:bg-slate-800/80">
                <div class="flex flex-1 items-center gap-4">
                    <div class="relative flex-1 max-w-xl">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 dark:text-slate-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="search" placeholder="Search pages, posts, media..." class="block w-full rounded-xl border-0 bg-slate-50 dark:bg-slate-700/50 py-2.5 pl-10 pr-4 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-teal-500/20 focus:ring-inset sm:text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Page
                    </a>
                    <button type="button" @click="dark = !dark" class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500/20" aria-label="Toggle dark mode">
                        <svg x-show="!dark" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="dark" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                    <button type="button" class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500/20">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-amber-500"></span>
                    </button>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" class="flex items-center gap-3 rounded-xl py-2 pl-2 pr-3 text-left transition hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-teal-500/20">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-teal-100 dark:bg-teal-900/50 text-sm font-semibold text-teal-700 dark:text-teal-300">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                            <div class="hidden text-left sm:block">
                                <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ auth()->user()->email ?? 'admin@tenwek.org' }}</p>
                            </div>
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-56 origin-top-right rounded-2xl bg-white dark:bg-slate-800 py-2 shadow-lg ring-1 ring-slate-200 dark:ring-slate-600 focus:outline-none">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                View site
                            </a>
                            <div class="my-1 border-t border-slate-100 dark:border-slate-600"></div>
                            <a href="{{ route('admin.settings.index') }}#profile" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Settings
                            </a>
                            <a href="{{ route('admin.settings.index') }}#backup" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Backup
                            </a>
                            <div class="my-1 border-t border-slate-100 dark:border-slate-600"></div>
                            <form method="POST" action="{{ route('admin.logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-left text-sm text-slate-700 dark:text-slate-200 hover:bg-red-50 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400">
                                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 lg:p-8">
                {{-- Toast notifications --}}
                <div class="fixed top-4 right-4 z-[100] flex flex-col gap-2 max-w-sm" aria-live="polite">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4500)" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm text-white shadow-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" class="rounded-xl bg-red-600 px-4 py-3 text-sm text-white shadow-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
