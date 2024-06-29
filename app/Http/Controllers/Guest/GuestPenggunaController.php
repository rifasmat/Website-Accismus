<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuestPenggunaController extends Controller
{
    public function profil()
    {
        $user = Auth::user(); // menmgambil data pengguna yang sedang login
        return view('guest.profil.list', compact('user'));
    }

    public function updateProfil(Request $request, $uuid)
    {
        // Ambil data pengguna berdasarkan user_uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,user_username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,user_email,' . $user->id,
            'wa' => 'nullable|string|max:20',
            'discord' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:5',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah digunakan, silahkan menggunakan username yang lain.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
            'wa.max' => 'Nomor WhatsApp maksimal 20 angka.',
            'discord.max' => 'Nama/Id Discord maksimal 255 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Update data pengguna
        $user->user_nama = $request->nama;
        $user->user_username = $request->username;
        $user->user_email = $request->email;
        $user->user_wa = $request->wa;
        $user->user_discord = $request->discord;

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika ada file foto yang diupload, simpan file baru dan hapus file lama
        if ($request->hasFile('foto')) {
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            $fotoPath = $request->file('foto')->storeAs('pengguna', $fileName, 'public');
            Storage::disk('public')->delete($user->user_foto);
            $user->user_foto = $fotoPath;
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('guest.profil.list')->with('success', 'Profil berhasil diperbarui.');
    }
}
