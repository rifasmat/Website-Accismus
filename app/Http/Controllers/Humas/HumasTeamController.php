<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HumasTeamController extends Controller
{
    public function index()
    {
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];
        $users = User::whereIn('role', $includedRoles)
            ->orderByRaw("FIELD(role, 'Guild Leader', 'Humas', 'Senate', 'Moderator')")
            ->paginate(10);

        return view('humas.team.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $allowedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];

        $users = User::whereIn('role', $allowedRoles)
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

        return view('humas.team.search', compact('users', 'search', 'administratorExists'));
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.team.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data team berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:5',
            'wa' => 'nullable|string|max:20',
            'discord' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama team tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah digunakan, silahkan menggunakan username yang lain.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
            'password.min' => 'Password harus minimal 5 karakter.',
            'wa.max' => 'Nomor WhatsApp maksimal 20 angka.',
            'discord.max' => 'Nama/Id Discord maksimal 255 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'role.required' => 'Role team harus diisi.',
        ]);

        // Simpan data role team sebelumnya
        $oldRole = $user->role;

        // Update data team
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->wa = $request->wa;
        $user->discord = $request->discord;

        // Periksa apakah team mengubah role
        if ($request->filled('role') && $request->role !== $user->role) {
            $user->role = $request->role;
        }

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika ada foto baru, update foto
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'team'
            $fotoPath = $request->file('foto')->storeAs('pengguna', $fileName, 'public');
            // Hapus foto lama jika ada
            Storage::disk('public')->delete($user->foto);
            // Update path foto
            $user->foto = $fotoPath;
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('humas.team.list');
    }
}
