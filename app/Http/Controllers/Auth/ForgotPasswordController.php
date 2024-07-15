<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\CustomResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $status = Password::broker()->sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                Mail::to($user->email)->send(new CustomResetPasswordMail($token, $user->email));
            }
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => 'Email berhasil dikirim, silahkan check email anda']);
        }

        return back()->withErrors(['email' => 'Gagal mengirimkan link reset password. Silakan coba lagi nanti.']);
    }
}
