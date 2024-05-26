<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HumasInformasiController extends Controller
{
    public function index()
    {
        return view('humas.informasi.list');
    }
}
