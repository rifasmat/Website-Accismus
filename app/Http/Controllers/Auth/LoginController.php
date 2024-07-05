<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $usernameOrEmail = $request->input('usernameemail');
        $password = $request->input('password');

        // Validasi input
        if (empty($usernameOrEmail) || empty($password)) {
            return back()->withErrors(['usernameemail' => 'Username/Email atau password tidak boleh kosong']);
        }

        // case-insensitive
        $user = User::where(function ($query) use ($usernameOrEmail) {
            $query->whereRaw('LOWER(email) = ?', [strtolower($usernameOrEmail)])
                ->orWhereRaw('LOWER(username) = ?', [strtolower($usernameOrEmail)]);
        })->first();

        if (!$user) {
            // Jika username/email tidak ditemukan
            return back()->withErrors(['usernameemail' => 'Username/Email Tidak Terdaftar']);
        }

        // Cek apakah password benar
        if (!Auth::attempt(['email' => $user->email, 'password' => $password])) {
            // Jika password salah
            return back()->withErrors(['password' => 'Password Salah']);
        }

        // Jika berhasil login
        $user = Auth::user();

        // Arahkan user ke dashboard sesuai role
        switch ($user->role) {
            case 'Administrator':
                return redirect('administrator/dashboard/list');
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
}
