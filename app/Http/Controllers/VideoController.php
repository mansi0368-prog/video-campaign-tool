<?php
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

public function index()
{
    $videos = auth()->user()->videos()->latest()->get();
    return view('videos.index', compact('videos'));
}

public function create()
{
    return view('videos.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'video' => 'required|file|mimes:mp4,mov,avi|max:102400' // 100MB
    ]);

    $file = $request->file('video');
    $path = $file->store('videos');

    $video = auth()->user()->videos()->create([
        'title' => $request->title,
        'original_filename' => $file->getClientOriginalName(),
        'path' => $path,
    ]);

    // ⏳ Dispatch processing job (we’ll do this next)
    ProcessVideo::dispatch($video);

    return redirect()->route('videos.index')->with('status', 'Video uploaded and queued for processing!');
}

