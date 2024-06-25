<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Informasi;

class ModeratorInformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::first();
        if ($informasi) {
            return view('moderator.informasi.list', compact('informasi'));
        }
    }
}
