<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Media;
use App\Models\CtcService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalPages = Page::count();
        $publishedPages = Page::where('status', 'published')->count();
        $draftPages = Page::where('status', 'draft')->count();
        $totalPosts = Post::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $archivedPosts = Post::where('status', 'archived')->count();
        $mediaCount = Media::count();
        $ctcServices = CtcService::where('is_visible', true)->count();

        $stats = [
            'pages' => $totalPages,
            'published_pages' => $publishedPages,
            'draft_pages' => $draftPages,
            'posts' => $totalPosts,
            'published_posts' => $publishedPosts,
            'archived_posts' => $archivedPosts,
            'media' => $mediaCount,
            'ctc_services' => $ctcServices,
        ];

        // Chart: content breakdown (pages, posts, media) for donut
        $chartContentBreakdown = [
            'labels' => ['Pages', 'Posts', 'Media'],
            'data' => [$totalPages, $totalPosts, $mediaCount],
            'colors' => ['#0d9488', '#f59e0b', '#64748b'],
        ];

        // Chart: pages by status (draft vs published)
        $chartPagesByStatus = [
            'labels' => ['Published', 'Draft'],
            'data' => [$publishedPages, $draftPages],
            'colors' => ['#059669', '#94a3b8'],
        ];

        // Chart: posts by status
        $postsPublished = Post::where('status', 'published')->count();
        $postsDraft = Post::where('status', 'draft')->count();
        $postsArchived = Post::where('status', 'archived')->count();
        $chartPostsByStatus = [
            'labels' => ['Published', 'Draft', 'Archived'],
            'data' => [$postsPublished, $postsDraft, $postsArchived],
            'colors' => ['#059669', '#f59e0b', '#94a3b8'],
        ];

        // Recent activity: last 7 days (posts + pages created) for bar chart
        $days = [];
        $postCounts = [];
        $pageCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $days[] = $date->format('D');
            $postCounts[] = Post::whereDate('created_at', $date)->count();
            $pageCounts[] = Page::whereDate('created_at', $date)->count();
        }
        $chartActivity = [
            'labels' => $days,
            'posts' => $postCounts,
            'pages' => $pageCounts,
        ];

        $recentPages = Page::latest()->take(5)->get();
        $recentPosts = Post::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentPages',
            'recentPosts',
            'chartContentBreakdown',
            'chartPagesByStatus',
            'chartPostsByStatus',
            'chartActivity'
        ));
    }
}
