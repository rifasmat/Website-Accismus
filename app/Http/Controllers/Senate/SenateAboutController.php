<?php

namespace App\Http\Controllers\Senate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SenateAboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        if ($about) {
            return view('senate.about.list', compact('about'));
        }
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'text' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.required' => 'Judul tidak boleh kosong.',
            'text.required' => 'Text tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Ambil teks dari form dan bersihkan dari tag HTML
        $cleanText = strip_tags($request->text);
        $cleanText = html_entity_decode($cleanText); // Dekode entitas HTML seperti &nbsp; menjadi karakter yang sesuai
        $cleanText = htmlspecialchars_decode($cleanText); // Dekode entitas HTML tambahan seperti &amp; menjadi karakter yang sesuai

        $about = About::where('about_uuid', $uuid)->first();
        if ($about) {
            $data = [
                'about_judul' => $request->judul,
                'about_text' => $cleanText,  // Sanitasi teks pesan
            ];

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($about->about_foto) {
                    Storage::delete('public/' . $about->about_foto);
                }

                // Simpan foto baru
                $path = $request->file('foto')->store('public/about');
                $data['about_foto'] = 'about/' . basename($path);
            }

            $about->update($data);
        }

        return redirect()->route('senate.about.list');
    }
}
