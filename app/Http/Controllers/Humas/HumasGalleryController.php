<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use Illuminate\Support\Str;

class HumasGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 gallery per halaman dengan urutan terbaru
        return view('humas.gallery.list', compact('galleries'));
    }


    public function create()
    {
        return view('humas.gallery.create');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $galleries = Gallery::where('galleries_judul', 'LIKE', "%{$search}%")
            ->orWhere('galleries_rf', 'LIKE', "%{$search}%")
            ->get();

        return view('humas.gallery.search', compact('galleries'));
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
            'galleries_judul' => $request->judul,
            'galleries_rf' => $request->rf,
            'galleries_foto' => $fotoPath,
            'galleries_uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('humas.gallery.list');
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $gallery = Gallery::where('galleries_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data gallery berdasarkan UUID
        $galleries = Gallery::where('galleries_uuid', $id)->firstOrFail();

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
        $galleries->galleries_judul = $request->judul;
        $galleries->galleries_rf = $request->rf;

        // Jika ada foto baru, update foto
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'pengguna'
            $fotoPath = $request->file('foto')->storeAs('Gallery', $fileName, 'public');
            // Hapus foto lama jika ada
            Storage::disk('public')->delete($galleries->galleries_foto);
            // Update path foto
            $galleries->galleries_foto = $fotoPath;
        }

        // Simpan perubahan
        $galleries->save();

        return redirect()->route('humas.gallery.list');
    }

    public function konfirmasi($uuid)
    {
        $galleries = Gallery::all();

        // Ambil data berdasarkan uuid
        $galleries = Gallery::where('galleries_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.gallery.konfirmasi', compact('galleries'));
    }

    public function destroy($uuid)
    {
        // Ambil data gallery berdasarkan UUID
        $galleries = Gallery::where('galleries_uuid', $uuid)->firstOrFail();

        // Hapus foto gallery dari storage jika ada
        if ($galleries->galleries_foto) {
            Storage::disk('public')->delete($galleries->galleries_foto);
        }

        // Hapus data gallery dari database
        $galleries->delete();

        return redirect()->route('humas.gallery.list')->with('success', 'Foto Berhasil Dihapus.');
    }
}
