<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class MemberGalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 gallery per halaman dengan urutan terbaru
        return view('member.gallery.list', compact('gallery'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $gallery = Gallery::where('gallery_judul', 'LIKE', "%{$search}%")
            ->orWhere('gallery_rf', 'LIKE', "%{$search}%")
            ->get();

        return view('member.gallery.search', compact('gallery'));
    }
}
