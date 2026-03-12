<?php

namespace App\Http\Controllers;

use App\Models\TiktokVideo;
use Illuminate\Http\Request;

class TiktokVideoController extends Controller
{
    public function index()
    {
        $videos = TiktokVideo::query()
            ->latest()
            ->get();

        return view('admin.tiktoks.index', [
            'videos' => $videos,
        ]);
    }

    public function create()
    {
        return view('admin.tiktoks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'embed_html' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        TiktokVideo::query()->create([
            'title' => $validated['title'],
            'embed_html' => $validated['embed_html'],
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => 0,
        ]);

        return redirect()
            ->route('admin.tiktoks.index')
            ->with('status', 'TikTok video added.');
    }

    public function destroy(TiktokVideo $tiktokVideo)
    {
        $tiktokVideo->delete();

        return redirect()
            ->route('admin.tiktoks.index')
            ->with('status', 'TikTok video deleted.');
    }
}

