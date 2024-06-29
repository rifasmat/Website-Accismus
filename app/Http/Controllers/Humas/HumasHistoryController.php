<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\History;
use Illuminate\Support\Str;

class HumasHistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 history rf per halaman dengan urutan terbaru
        return view('humas.history-rf.list', compact('history'));
    }


    public function create()
    {
        return view('humas.history-rf.create');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $history = History::where('history_rf', 'LIKE', "%{$search}%")
            ->orWhere('history_tahun', 'LIKE', "%{$search}%")
            ->get();

        return view('humas.history-rf.search', compact('history'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rf' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'rf.required' => 'Nama RF tidak boleh kosong.',
            'tahun.required' => 'Tahun bermain tidak boleh kosong.',
            'foto.required' => 'Foto tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'history'
            $fotoPath = $request->file('foto')->storeAs('history-rf', $fileName, 'public');
        }

        // Buat history baru
        History::create([
            'history_rf' => $request->rf,
            'history_tahun' => $request->tahun,
            'history_foto' => $fotoPath,
            'history_uuid' => (string) Str::uuid(),
        ]);

        return redirect()->route('humas.history-rf.list');
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $history = History::where('history_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.history-rf.edit', compact('history'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data history berdasarkan UUID
        $history = History::where('history_uuid', $id)->firstOrFail();

        $request->validate([
            'rf' => 'required|string|max:255',
            'tahun' => 'required|integer|digits:4',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'rf.required' => 'Nama RF tidak boleh kosong.',
            'tahun.required' => 'Tahun bermain tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Update data pengguna
        $history->history_rf = $request->rf;

        // Jika ada foto baru, update foto
        if ($request->hasFile('foto')) {
            // Generate nama file unik
            $fileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
            // Simpan file ke direktori 'pengguna'
            $fotoPath = $request->file('foto')->storeAs('history-rf', $fileName, 'public');
            // Hapus foto lama jika ada
            Storage::disk('public')->delete($history->history_foto);
            // Update path foto
            $history->history_foto = $fotoPath;
        }

        // Simpan perubahan
        $history->save();

        return redirect()->route('humas.history-rf.list');
    }

    public function konfirmasi($uuid)
    {
        $history = History::all();

        // Ambil data berdasarkan uuid
        $history = History::where('history_uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('humas.history-rf.konfirmasi', compact('history'));
    }

    public function destroy($uuid)
    {
        // Ambil data history berdasarkan UUID
        $history = History::where('history_uuid', $uuid)->firstOrFail();

        // Hapus foto history dari storage jika ada
        if ($history->history_foto) {
            Storage::disk('public')->delete($history->history_foto);
        }

        // Hapus data history dari database
        $history->delete();

        return redirect()->route('humas.history-rf.list')->with('success', 'Foto Berhasil Dihapus.');
    }
}
