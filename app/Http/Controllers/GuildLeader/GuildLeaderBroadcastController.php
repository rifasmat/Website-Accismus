<?php

namespace App\Http\Controllers\GuildLeader;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;
use Carbon\Carbon;

class GuildLeaderBroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::orderBy('created_at', 'desc')->paginate(10); // Menampilkan 10 data halaman dengan urutan terbaru
        return view('guildleader.broadcast.history', compact('broadcasts'));
    }

    public function create()
    {
        return view('guildleader.broadcast.create');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $broadcasts = Broadcast::where('broadcast_sentby', 'LIKE', "%{$search}%")
            ->orWhere('broadcast_subject', 'LIKE', "%{$search}%")
            ->orWhere('broadcast_tanggal', 'LIKE', "%{$search}%")
            ->get();

        return view('guildleader.broadcast.search', compact('broadcasts'));
    }

    public function searchMail(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('nama', 'LIKE', "%{$search}%")
            ->orWhere('username', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->get();

        return view('guildleader.broadcast.searchmail', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'subject' => 'required|string|max:255',
            'text' => 'required|string',
        ], [
            'subject.required' => 'Subject tidak boleh kosong.',
            'text.required' => 'Pesan tidak boleh kosong.',
        ]);

        // Ambil semua email pengguna kecuali yang memiliki role 'Guest'
        $penerimaEmails = User::where('role', '!=', 'Guest')->pluck('email')->toArray();
        $broadcastPenerima = implode(',', $penerimaEmails);

        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil teks dari form dan bersihkan dari tag HTML
        $cleanText = strip_tags($request->text);
        $cleanText = html_entity_decode($cleanText); // Dekode entitas HTML seperti &nbsp; menjadi karakter yang sesuai
        $cleanText = htmlspecialchars_decode($cleanText); // Dekode entitas HTML tambahan seperti &amp; menjadi karakter yang sesuai

        $broadcast = new Broadcast([
            'broadcast_pengirim_email' => 'accismuscommunity@gmail.com',
            'broadcast_penerima' => $broadcastPenerima,
            'broadcast_subject' => $request->subject,
            'broadcast_pesan' => $cleanText,  // Sanitasi teks pesan
            'broadcast_tanggal' => now()->toDateTimeString(),
            'broadcast_sentby' => $user->nama, // Isi dengan nama pengguna yang sedang login
        ]);

        try {
            // Kirim email menggunakan Mail facade
            Mail::raw($broadcast->broadcast_pesan, function ($message) use ($broadcast, $penerimaEmails) {
                $message->from($broadcast->broadcast_pengirim_email, 'Accismus Community');
                $message->to($penerimaEmails);
                $message->subject($broadcast->broadcast_subject);
            });

            // Jika email berhasil dikirim, set status ke 'Sent'
            $broadcast->broadcast_status = 'Sent';
        } catch (Exception $e) {
            // Jika pengiriman email gagal, set status ke 'Failed' dan log error
            $broadcast->broadcast_status = 'Failed';
            Log::error('Error sending email:', ['error' => $e->getMessage()]);
        }

        // Simpan data broadcast ke dalam database
        $broadcast->save();

        return redirect()->route('guildleader.broadcast.history')->with('success', 'Broadcast Email Berhasil Dikirim.');
    }

    public function email()
    {
        // Ambil semua pengguna kecuali yang memiliki role 'Guest'
        $users = User::where('role', '!=', 'Guest')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menampilkan 10 data halaman dengan urutan terbaru

        return view('guildleader.broadcast.email', compact('users'));
    }
}
