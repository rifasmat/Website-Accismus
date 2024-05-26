<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HumasAboutController extends Controller
{
    public function index()
    {
        return view('humas.about.list');
    }
}
