<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GuestGalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 gallery per halaman dengan urutan terbaru
        return view('guest.gallery.list', compact('gallery'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $gallery = Gallery::where('gallery_judul', 'LIKE', "%{$search}%")
            ->orWhere('gallery_rf', 'LIKE', "%{$search}%")
            ->get();

        return view('guest.gallery.search', compact('gallery'));
    }
}
