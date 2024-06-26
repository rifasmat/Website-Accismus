<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Informasi;

class MemberInformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::first();
        if ($informasi) {
            return view('member.informasi.list', compact('informasi'));
        }
    }
}
