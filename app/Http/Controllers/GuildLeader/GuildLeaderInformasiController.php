<?php

namespace App\Http\Controllers\GuildLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Str;

class GuildLeaderInformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::first();
        if ($informasi) {
            return view('guildleader.informasi.list', compact('informasi'));
        }
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'required|string|max:255',
            'rf' => 'required|string|max:255',
            'instagram' => 'required|string|min:5',
            'discord' => 'required|string|max:20',
            'wa' => 'required|string|max:255',
        ], [
            'judul.required' => 'Judul tidak boleh kosong.',
            'subjudul.required' => 'Sub Judul tidak boleh kosong.',
            'rf.required' => 'RF tidak boleh kosong.',
            'instagram.required' => 'Instagram tidak boleh kosong.',
            'discord.required' => 'Discord tidak boleh kosong.',
            'wa.required' => 'Nomer Whatsapp tidak boleh kosong',
        ]);

        // Add prefixes to the URLs
        $instagramLink = 'https://www.instagram.com/' . ltrim($request->instagram, '/');
        $discordLink = 'https://discord.gg/' . ltrim($request->discord, '/');
        $waLink = 'https://wa.me/' . ltrim($request->wa, '/');

        $informasi = Informasi::where('informasi_uuid', $uuid)->first();
        if ($informasi) {
            $informasi->update([
                'informasi_judul' => $request->judul,
                'informasi_subjudul' => $request->subjudul,
                'informasi_rf' => $request->rf,
                'informasi_instagram' => $instagramLink,
                'informasi_discord' => $discordLink,
                'informasi_wa' => $waLink,
            ]);
        }

        return redirect()->route('guildleader.informasi.list');
    }
}
