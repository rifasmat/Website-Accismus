<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HumasPenggunaController extends Controller
{

    public function index()
    {
        $users = User::where('user_role', '!=', 'Administrator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('humas.pengguna.list', compact('users'));
    }

    public function create()
    {
        return view('humas.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,user_username',
            'email' => 'required|string|email|max:255|unique:users,user_email',
            'password' => 'required|string|min:5',
            'wa' => 'nullable|string|max:20',
            'discord' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah digunakan, silahkan menggunakan username yang lain.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password harus minimal 5 karakter.',
            'wa.max' => 'Nomor WhatsApp maksimal 20 angka.',
            'discord.max' => 'Nama/Id Discord maksimal 255 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'role.required' => 'Role pengguna harus diisi.',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'pengguna'
            $fotoPath = $request->file('foto')->storeAs('pengguna', $fileName, 'public');
        } else {
            // Menggunakan foto default jika tidak ada foto yang diupload
            $fileName = Str::random(20) . '.png';
            // Copy file default ke direktori 'pengguna' dengan nama yang di-generate secara acak
            Storage::disk('public')->copy('pengguna/default.png', 'pengguna/' . $fileName);
            $fotoPath = 'pengguna/' . $fileName;
        }

        // Buat pengguna baru
        User::create([
            'user_nama' => $request->nama,
            'user_username' => $request->username,
            'user_email' => $request->email,
            'password' => Hash::make($request->password),
            'user_wa' => $request->wa,
            'user_discord' => $request->discord,
            'user_foto' => $fotoPath,
            'user_role' => $request->role,
        ]);

        return redirect()->route('humas.pengguna.list');
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $uuid)
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

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('humas.pengguna.list')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function konfirmasi($uuid)
    {
        $user = User::all();

        // Ambil data berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.pengguna.konfirmasi', compact('user'));
    }

    public function destroy($uuid)
    {
        // Ambil data pengguna berdasarkan UUID
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Hapus foto pengguna dari storage jika ada
        if ($user->user_foto) {
            Storage::disk('public')->delete($user->user_foto);
        }

        // Hapus data pengguna dari database
        $user->delete();

        return redirect()->route('humas.pengguna.list')->with('success', 'Pengguna Berhasil Dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::where('user_role', '!=', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%")
                    ->orWhere('user_email', 'LIKE', "%{$search}%");
            })
            ->get();

        $administratorExists = User::where('user_role', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%")
                    ->orWhere('user_email', 'LIKE', "%{$search}%");
            })
            ->exists();

        return view('humas.pengguna.search', compact('users', 'search', 'administratorExists'));
    }

    public function profil()
    {
        $user = Auth::user(); // menmgambil data pengguna yang sedang login
        return view('humas.profil.list', compact('user'));
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
        return redirect()->route('humas.profil.list')->with('success', 'Profil berhasil diperbarui.');
    }
}
