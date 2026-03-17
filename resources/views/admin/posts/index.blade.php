@extends('admin.layouts.app')

@section('title', 'News & Posts')

@section('content')
    <x-admin.breadcrumb :items="['News & Posts' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">News & Posts</h1>
            <p class="mt-1 text-slate-600">Manage blog posts and announcements.</p>
        </div>
        <x-admin.button variant="primary" size="md">Add Post</x-admin.button>
    </div>

    <x-admin.card padding="false">
        @if($posts->isEmpty())
            <div class="p-12 text-center text-slate-500">No posts yet.</div>
        @else
            <x-admin.table>
                <x-slot name="head">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Category</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach($posts as $post)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $post->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4"><span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $post->status }}</span></td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $post->updated_at->format('M j, Y') }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-admin.table>
            @if($posts->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">{{ $posts->links() }}</div>
            @endif
        @endif
    </x-admin.card>
@endsection
