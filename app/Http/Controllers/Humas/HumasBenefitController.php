<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benefit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HumasBenefitController extends Controller
{
    public function index()
    {
        $benefit = Benefit::first();
        if ($benefit) {
            return view('humas.benefit.list', compact('benefit'));
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

        $benefit = Benefit::where('benefit_uuid', $uuid)->first();
        if ($benefit) {
            $data = [
                'benefit_judul' => $request->judul,
                'benefit_text' => $request->text,
            ];

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($benefit->benefit_foto) {
                    Storage::delete('public/' . $benefit->benefit_foto);
                }

                // Simpan foto baru
                $path = $request->file('foto')->store('public/benefit');
                $data['benefit_foto'] = 'benefit/' . basename($path);
            }

            $benefit->update($data);
        }

        return redirect()->route('humas.benefit.list');
    }
}
