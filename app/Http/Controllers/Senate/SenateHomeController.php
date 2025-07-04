<?php

namespace App\Http\Controllers\Senate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\About;
use App\Models\Benefit;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;

class SenateHomeController extends Controller
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
        $users = User::whereIn('role', $roles)
            ->get()
            ->sortBy(function ($user) use ($roles) {
                return array_search($user->role, $roles);
            });

        // Kembalikan data ke tampilan
        return view('senate.home', compact('informasi', 'about', 'benefits', 'gallery', 'history', 'users'));
    }
}
