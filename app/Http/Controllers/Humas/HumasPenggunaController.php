<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HumasPenggunaController extends Controller
{
    public function index()
    {
        return view('humas.pengguna.list');
    }

    public function create()
    {
        return view('humas.pengguna.create');
    }

    public function store(Request $request)
    {
        // Validasi data dengan pesan kustom
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,user_username',
            'email' => 'required|string|email|max:255|unique:users,user_email',
            'password' => 'required|string|min:8|confirmed',
            'wa' => 'nullable|string|max:20',
            'discord' => 'nullable|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah digunakan, silahkan menggunakan username yang lain.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'wa.max' => 'Nomor WhatsApp maksimal 8 angka.',
            'discord.max' => 'Nama/Id Discord maksimal 255 karakter.',
            'foto.required' => 'Foto pengguna harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'role.required' => 'Role pengguna harus diisi.',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('user_foto')) {
            $fotoPath = $request->file('user_foto')->store('user_fotos', 'public');
        }

        // Buat pengguna baru
        User::create([
            'user_nama' => $request->user_nama,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'password' => Hash::make($request->password),
            'user_wa' => $request->user_wa,
            'user_discord' => $request->user_discord,
            'user_foto' => $fotoPath,
            'user_role' => $request->user_role,
        ]);

        return redirect()->route('humas.pengguna.create')->with('success', 'User created successfully.');
    }
}
