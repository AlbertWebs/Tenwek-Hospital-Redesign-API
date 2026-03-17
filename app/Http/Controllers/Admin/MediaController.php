<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $media = Media::latest()->paginate(24);
        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'], // 10MB
        ]);

        $file = $request->file('file');
        $path = $file->store('media/' . date('Y/m'), 'public');

        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'file_name' => $file->getClientOriginalName(),
            'path' => $path,
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'id' => $media->id,
            'url' => $media->url,
            'file_name' => $media->file_name,
        ], 201);
    }
}
