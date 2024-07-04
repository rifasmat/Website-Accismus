<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModeratorPenggunaController extends Controller
{

    public function index()
    {
        $users = User::where('role', '!=', 'Administrator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('moderator.pengguna.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::where('role', '!=', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get();

        $administratorExists = User::where('role', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->exists();

        return view('moderator.pengguna.search', compact('users', 'search', 'administratorExists'));
    }

    public function profil()
    {
        $user = Auth::user(); // menmgambil data pengguna yang sedang login
        return view('moderator.profil.list', compact('user'));
    }

    public function updateProfil(Request $request, $uuid)
    {
        // Ambil data pengguna berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
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
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->wa = $request->wa;
        $user->discord = $request->discord;

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika ada file foto yang diupload, simpan file baru dan hapus file lama
        if ($request->hasFile('foto')) {
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            $fotoPath = $request->file('foto')->storeAs('pengguna', $fileName, 'public');
            Storage::disk('public')->delete($user->foto);
            $user->foto = $fotoPath;
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('moderator.profil.list')->with('success', 'Profil berhasil diperbarui.');
    }
}
