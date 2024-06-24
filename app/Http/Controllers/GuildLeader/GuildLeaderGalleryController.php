<?php

namespace App\Http\Controllers\GuildLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use Illuminate\Support\Str;

class GuildLeaderGalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 gallery per halaman dengan urutan terbaru
        return view('guildleader.gallery.list', compact('gallery'));
    }


    public function create()
    {
        return view('guildleader.gallery.create');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $gallery = Gallery::where('gallery_judul', 'LIKE', "%{$search}%")
            ->orWhere('gallery_rf', 'LIKE', "%{$search}%")
            ->get();

        return view('guildleader.gallery.search', compact('gallery'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'rf' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.required' => 'Judul foto tidak boleh kosong.',
            'rf.required' => 'Nama RF tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'gallery'
            $fotoPath = $request->file('foto')->storeAs('gallery', $fileName, 'public');
        }

        // Buat gallery baru
        Gallery::create([
            'gallery_judul' => $request->judul,
            'gallery_rf' => $request->rf,
            'gallery_foto' => $fotoPath,
            'gallery_uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('guildleader.gallery.list');
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $gallery = Gallery::where('gallery_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('guildleader.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data gallery berdasarkan UUID
        $gallery = Gallery::where('gallery_uuid', $id)->firstOrFail();

        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'rf' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.required' => 'Judul foto tidak boleh kosong.',
            'rf.required' => 'Nama RF tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Update data pengguna
        $gallery->gallery_judul = $request->judul;
        $gallery->gallery_rf = $request->rf;

        // Jika ada foto baru, update foto
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'pengguna'
            $fotoPath = $request->file('foto')->storeAs('gallery', $fileName, 'public');
            // Hapus foto lama jika ada
            Storage::disk('public')->delete($gallery->gallery_foto);
            // Update path foto
            $gallery->gallery_foto = $fotoPath;
        }

        // Simpan perubahan
        $gallery->save();

        return redirect()->route('guildleader.gallery.list');
    }

    public function konfirmasi($uuid)
    {
        $gallery = Gallery::all();

        // Ambil data berdasarkan uuid
        $gallery = Gallery::where('gallery_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('guildleader.gallery.konfirmasi', compact('gallery'));
    }

    public function destroy($uuid)
    {
        // Ambil data gallery berdasarkan UUID
        $gallery = Gallery::where('gallery_uuid', $uuid)->firstOrFail();

        // Hapus foto gallery dari storage jika ada
        if ($gallery->gallery_foto) {
            Storage::disk('public')->delete($gallery->gallery_foto);
        }

        // Hapus data gallery dari database
        $gallery->delete();

        return redirect()->route('guildleader.gallery.list')->with('success', 'Foto Berhasil Dihapus.');
    }
}
