@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 40px -15px rgba(0,0,0,0.12); }
    .progress-ring { transform: rotate(-90deg); }
    .progress-ring__circle { transition: stroke-dashoffset 0.6s ease; }
</style>
@endpush

@section('content')
    <x-admin.breadcrumb :items="['Dashboard' => null]" />

    {{-- Welcome strip --}}
    <div class="mb-8 rounded-2xl bg-gradient-to-br from-teal-600 via-teal-700 to-slate-800 px-6 py-8 text-white shadow-lg sm:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">Welcome back</h1>
                <p class="mt-1 text-teal-100">Here’s what’s happening with your site today.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/20 px-4 py-2.5 text-sm font-medium backdrop-blur hover:bg-white/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New page
                </a>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/20 px-4 py-2.5 text-sm font-medium backdrop-blur hover:bg-white/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16v6m3-3v3m0-3v-3m0 3v-3m0-3v3"/></svg>
                    New post
                </a>
            </div>
        </div>
    </div>

    {{-- Stats row --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-admin.card class="stat-card overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total pages</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['pages'] }}</p>
                    <p class="mt-2 text-xs text-slate-400">{{ $stats['published_pages'] }} published · {{ $stats['draft_pages'] }} draft</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-teal-600">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                <div class="h-full rounded-full bg-teal-500 transition-all" style="width: {{ $stats['pages'] > 0 ? min(100, ($stats['published_pages'] / $stats['pages']) * 100) : 0 }}%"></div>
            </div>
        </x-admin.card>
        <x-admin.card class="stat-card overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Posts</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['posts'] }}</p>
                    <p class="mt-2 text-xs text-slate-400">{{ $stats['published_posts'] }} published</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16v6m3-3v3m0-3v-3m0 3v-3m0-3v3"/></svg>
                </div>
            </div>
            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                <div class="h-full rounded-full bg-amber-500 transition-all" style="width: {{ $stats['posts'] > 0 ? min(100, ($stats['published_posts'] / $stats['posts']) * 100) : 0 }}%"></div>
            </div>
        </x-admin.card>
        <x-admin.card class="stat-card overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Media files</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['media'] }}</p>
                    <p class="mt-2 text-xs text-slate-400">In library</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6 6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
        </x-admin.card>
        <x-admin.card class="stat-card overflow-hidden">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">CTC services</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['ctc_services'] }}</p>
                    <p class="mt-2 text-xs text-slate-400">Visible on site</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
            </div>
        </x-admin.card>
    </div>

    {{-- Charts row --}}
    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <x-admin.card>
            <x-slot name="header">
                <h2 class="text-lg font-semibold text-slate-900">Content overview</h2>
                <p class="mt-0.5 text-sm text-slate-500">Pages, posts, and media</p>
            </x-slot>
            <div class="flex flex-col items-center gap-6 sm:flex-row sm:justify-around">
                <div class="relative h-52 w-52">
                    <canvas id="chartContentBreakdown" width="208" height="208"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-slate-700">{{ $stats['pages'] + $stats['posts'] + $stats['media'] }}</span>
                        <span class="ml-1 text-sm text-slate-500">total</span>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-teal-500"></span>
                        <span class="text-sm text-slate-600">Pages <strong>{{ $stats['pages'] }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-amber-500"></span>
                        <span class="text-sm text-slate-600">Posts <strong>{{ $stats['posts'] }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-slate-500"></span>
                        <span class="text-sm text-slate-600">Media <strong>{{ $stats['media'] }}</strong></span>
                    </div>
                </div>
            </div>
        </x-admin.card>
        <x-admin.card>
            <x-slot name="header">
                <h2 class="text-lg font-semibold text-slate-900">Activity (last 7 days)</h2>
                <p class="mt-0.5 text-sm text-slate-500">New pages and posts</p>
            </x-slot>
            <div class="h-64">
                <canvas id="chartActivity"></canvas>
            </div>
        </x-admin.card>
    </div>

    {{-- Second charts row: status breakdown --}}
    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <x-admin.card>
            <x-slot name="header">
                <h2 class="text-lg font-semibold text-slate-900">Pages by status</h2>
            </x-slot>
            <div class="flex flex-col items-center sm:flex-row sm:justify-around">
                <div class="h-44 w-44">
                    <canvas id="chartPagesByStatus"></canvas>
                </div>
                <div class="mt-4 flex flex-wrap justify-center gap-4 sm:mt-0">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-emerald-600">{{ $stats['published_pages'] }}</p>
                        <p class="text-xs text-slate-500">Published</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-400">{{ $stats['draft_pages'] }}</p>
                        <p class="text-xs text-slate-500">Draft</p>
                    </div>
                </div>
            </div>
        </x-admin.card>
        <x-admin.card>
            <x-slot name="header">
                <h2 class="text-lg font-semibold text-slate-900">Posts by status</h2>
            </x-slot>
            <div class="flex flex-col items-center sm:flex-row sm:justify-around">
                <div class="h-44 w-44">
                    <canvas id="chartPostsByStatus"></canvas>
                </div>
                <div class="mt-4 flex flex-wrap justify-center gap-4 sm:mt-0">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-emerald-600">{{ $stats['published_posts'] }}</p>
                        <p class="text-xs text-slate-500">Published</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-amber-500">{{ $stats['posts'] - $stats['published_posts'] - ($stats['archived_posts'] ?? 0) }}</p>
                        <p class="text-xs text-slate-500">Draft</p>
                    </div>
                </div>
            </div>
        </x-admin.card>
    </div>

    {{-- Recent content --}}
    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <x-admin.card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Recent pages</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Latest updates</p>
                    </div>
                    <a href="{{ route('admin.pages.index') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">View all</a>
                </div>
            </x-slot>
            @if($recentPages->isEmpty())
                <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-12 text-center">
                    <p class="text-slate-500">No pages yet.</p>
                    <a href="{{ route('admin.pages.create') }}" class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Create your first page</a>
                </div>
            @else
                <ul class="space-y-1">
                    @foreach($recentPages as $page)
                        <li class="flex items-center justify-between rounded-xl px-3 py-2.5 transition hover:bg-slate-50">
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="block truncate font-medium text-slate-900 hover:text-teal-600">{{ $page->title }}</a>
                                <p class="truncate text-sm text-slate-500">/{{ $page->slug }}</p>
                            </div>
                            <span class="ml-3 shrink-0 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $page->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $page->status }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-admin.card>
        <x-admin.card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Recent posts</h2>
                        <p class="mt-0.5 text-sm text-slate-500">News & announcements</p>
                    </div>
                    <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">View all</a>
                </div>
            </x-slot>
            @if($recentPosts->isEmpty())
                <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-12 text-center text-slate-500">No posts yet.</div>
            @else
                <ul class="space-y-1">
                    @foreach($recentPosts as $post)
                        <li class="flex items-center justify-between rounded-xl px-3 py-2.5 transition hover:bg-slate-50">
                            <a href="#" class="min-w-0 flex-1 truncate font-medium text-slate-900 hover:text-teal-600">{{ $post->title }}</a>
                            <span class="ml-3 shrink-0 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $post->status }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-admin.card>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const teal = '#0d9488';
            const amber = '#f59e0b';
            const slate = '#64748b';
            const emerald = '#059669';
            const gray = '#94a3b8';

            // Content breakdown (doughnut)
            new Chart(document.getElementById('chartContentBreakdown'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartContentBreakdown['labels']),
                    datasets: [{
                        data: @json($chartContentBreakdown['data']),
                        backgroundColor: [teal, amber, slate],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '68%',
                    plugins: { legend: { display: false } }
                }
            });

            // Activity (bar)
            new Chart(document.getElementById('chartActivity'), {
                type: 'bar',
                data: {
                    labels: @json($chartActivity['labels']),
                    datasets: [
                        { label: 'Posts', data: @json($chartActivity['posts']), backgroundColor: amber, borderRadius: 6 },
                        { label: 'Pages', data: @json($chartActivity['pages']), backgroundColor: teal, borderRadius: 6 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } }
                    },
                    plugins: { legend: { position: 'top' } }
                }
            });

            // Pages by status (doughnut)
            new Chart(document.getElementById('chartPagesByStatus'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartPagesByStatus['labels']),
                    datasets: [{
                        data: @json($chartPagesByStatus['data']),
                        backgroundColor: [emerald, gray],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '60%',
                    plugins: { legend: { display: false } }
                }
            });

            // Posts by status (doughnut)
            new Chart(document.getElementById('chartPostsByStatus'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartPostsByStatus['labels']),
                    datasets: [{
                        data: @json($chartPostsByStatus['data']),
                        backgroundColor: [emerald, amber, gray],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '60%',
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
    @endpush
@endsection
