<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Feed;

class FeedController extends Controller
{
    /**
     * Menampilkan halaman profil dengan feed.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $feeds = Feed::where('user_id', $user->id)->latest()->get(); // Mengambil feed pengguna yang sedang login
        return view('feed.index', compact('user', 'feeds'));
    }

    public function create()
    {
        $user = auth()->user(); // Mendapatkan data pengguna yang sedang login
        return view('feed.create', compact('user')); // Mengarahkan ke halaman form unggah feed
    }
    
    public function upload(Request $request)
    {
        // Validasi file dan caption
        $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,mov|max:153600', // Maks 150MB
            'caption' => 'nullable|string|max:500',
        ]);

        // Simpan file media ke storage
        $filePath = $request->file('media')->store('uploads', 'public');

        // Simpan data ke database
        Feed::create([
            'user_id' => auth()->id(),
            'media' => $filePath,
            'caption' => $request->caption,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('feed.index')->with('success', 'Unggahan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit feed.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
{
    $feed = Feed::findOrFail($id);

    // Pastikan hanya pemilik feed yang bisa mengedit
    if ($feed->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('feed.edit', compact('feed'));
}


    /**
     * Memperbarui feed di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $feed = Feed::findOrFail($id);

    // Pastikan hanya pemilik feed yang bisa mengedit
    if ($feed->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Validasi input
    $request->validate([
        'media' => 'nullable|mimes:jpeg,png,jpg,mp4,mov|max:153600', // Maks 150MB
        'caption' => 'nullable|string|max:500',
    ]);

    // Jika ada file baru, hapus file lama dan unggah file baru
    if ($request->hasFile('media')) {
        Storage::disk('public')->delete($feed->media);
        $feed->media = $request->file('media')->store('uploads', 'public');
    }

    // Update caption
    $feed->caption = $request->caption;
    $feed->save();

    return redirect()->route('feed.index')->with('success', 'Feed berhasil diperbarui!');
}


}
