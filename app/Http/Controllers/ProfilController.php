<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = auth()->user(); // Mengambil data pengguna yang sedang login
        return view('profile.index', compact('user'));
    }

    /**
     * Tampilkan halaman edit profil.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Perbarui data profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        // Periksa apakah ada file foto profil yang diunggah
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                \Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan foto profil baru
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $filePath;
        }

        // Perbarui name dan bio
        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($user->save()) {
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->route('profile.edit')->withErrors(['error' => 'Gagal memperbarui profil.']);
    }
}
