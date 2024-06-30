<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Informasi;
use App\Models\About;
use App\Models\Benefit;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari model Informasi
        $informasi = Informasi::all();

        // Ambil data dari model About
        $about = About::all();

        // Ambil data dari model Benefit
        $benefits = Benefit::all();

        // Ambil data dari model Gallery
        $gallery = Gallery::orderBy('created_at', 'desc')->get();

        // Ambil data dari model History RF
        $history = History::orderBy('created_at', 'desc')->get();

        // Definisikan urutan peran
        $roles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];

        // Ambil data users dan urutkan berdasarkan urutan peran
        $users = User::whereIn('user_role', $roles)
            ->get()
            ->sortBy(function ($user) use ($roles) {
                return array_search($user->user_role, $roles);
            });

        // Kembalikan data ke tampilan
        return view('home', compact('informasi', 'about', 'benefits', 'gallery', 'history', 'users'));
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function processLogin(Request $request)
    {
        $usernameOrEmail = $request->input('usernameemail');
        $password = $request->input('password');

        // Validasi input
        if (empty($usernameOrEmail) || empty($password)) {
            return back()->withErrors(['usernameemail' => 'Username/Email atau password tidak boleh kosong']);
        }

        // Cek apakah username/email ada di database
        $user = User::where('user_email', $usernameOrEmail)
            ->orWhere('user_username', $usernameOrEmail)
            ->first();

        if (!$user) {
            // Jika username/email tidak ditemukan
            return back()->withErrors(['usernameemail' => 'Username/Email Salah']);
        }

        // Cek apakah password benar
        if (!Auth::attempt(['user_email' => $user->user_email, 'password' => $password])) {
            // Jika password salah
            return back()->withErrors(['password' => 'Password Salah']);
        }

        // Jika berhasil login
        $user = Auth::user();

        // Arahkan user ke dashboard sesuai role
        switch ($user->user_role) {
            case 'Administrator':
                return redirect('/administrator/home');
            case 'Guild Leader':
                return redirect('/guildleader/home');
            case 'Humas':
                return redirect('/humas/home');
            case 'Senate':
                return redirect('/senate/home');
            case 'Moderator':
                return redirect('/moderator/home');
            case 'Member':
                return redirect('/member/home');
            case 'Guest':
                return redirect('/guest/home');
            default:
                return redirect('/');
        }
    }

    public function processRegister(Request $request)
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

        // Arahkan user ke halaman guest/home dan tampilkan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
