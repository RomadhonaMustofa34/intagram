<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Feed;
use App\Models\Comment; 
use Auth;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $feeds = Feed::where('user_id', $user->id)->latest()->get(); 
        return view('feed.index', compact('user', 'feeds'));
    }

    public function create()
    {
        $user = auth()->user(); 
        return view('feed.create', compact('user')); 
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,mov|max:153600', // Maks 150MB
            'caption' => 'nullable|string|max:500',
        ]);

        $filePath = $request->file('media')->store('uploads', 'public');

        Feed::create([
            'user_id' => auth()->id(),
            'media' => $filePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('feed.index')->with('success', 'Unggahan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $feed = Feed::findOrFail($id);

        if ($feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('feed.edit', compact('feed'));
    }

    public function update(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);

        if ($feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'media' => 'nullable|mimes:jpeg,png,jpg,mp4,mov|max:153600',
            'caption' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('media')) {
            Storage::disk('public')->delete($feed->media);
            $feed->media = $request->file('media')->store('uploads', 'public');
        }

        $feed->caption = $request->caption;
        $feed->save();

        return redirect()->route('feed.index')->with('success', 'Feed berhasil diperbarui!');
    }

    /**
     * Menghapus feed dari database dan storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);

        if ($feed->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

 
        Storage::disk('public')->delete($feed->media);

 
        $feed->delete();

        return redirect()->route('feed.index')->with('success', 'Feed berhasil dihapus.');
    }

    public function showComments($id)
{

    $feed = Feed::findOrFail($id);


    $comments = $feed->comments;


    return view('feed.show', compact('feed', 'comments'));
}


    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|max:255', 
        ]);

        $feed = Feed::findOrFail($id);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->feed_id = $feed->id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('feed.comments', $feed->id)->with('success', 'Komentar berhasil ditambahkan.');
    }
    
}
