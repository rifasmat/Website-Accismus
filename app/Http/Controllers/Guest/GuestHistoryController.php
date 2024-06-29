<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class GuestHistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->paginate(9); // Menampilkan 9 history rf per halaman dengan urutan terbaru
        return view('guest.history-rf.list', compact('history'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $history = History::where('history_rf', 'LIKE', "%{$search}%")
            ->orWhere('history_tahun', 'LIKE', "%{$search}%")
            ->get();

        return view('guest.history-rf.search', compact('history'));
    }
}
