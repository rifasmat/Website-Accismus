<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
    }

    public function login()
    {
        return view('home.login');
    }

    public function register()
    {
        return view('home.register');
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
            case 'Humas':
                return redirect('/humas/dashboard/list');
            case 'Guild Leader':
                return redirect('/guildleader/dashboard');
            case 'Moderator':
                return redirect('/moderator/dashboard');
            default:
                return redirect('/');
        }
    }

    public function processRegister(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,user_username',
            'email' => 'required|string|email|max:255|unique:users,user_email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'user_username' => $request->input('username'),
            'user_email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash password sebelum menyimpan
            'user_role' => 'User', // Atur role default, misalnya 'User'
        ]);

        // Lakukan login otomatis setelah registrasi
        Auth::login($user);

        // Arahkan user ke halaman dashboard atau halaman lain yang diinginkan
        return redirect('/user/dashboard')->with('success', 'Registrasi berhasil! Anda telah login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
