<?php

namespace App\Http\Controllers\Humas;

use App\Http\Controllers\Controller;

class HumasDashboardController extends Controller
{
    public function index()
    {
        return view('humas.dashboard.list');
    }
}
