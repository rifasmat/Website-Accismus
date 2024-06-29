<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use Illuminate\Support\Str;

class ModeratorGalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 gallery per halaman dengan urutan terbaru
        return view('moderator.gallery.list', compact('gallery'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $gallery = Gallery::where('gallery_judul', 'LIKE', "%{$search}%")
            ->orWhere('gallery_rf', 'LIKE', "%{$search}%")
            ->get();

        return view('moderator.gallery.search', compact('gallery'));
    }
}
