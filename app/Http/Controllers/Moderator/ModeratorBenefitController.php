<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Benefit;

class ModeratorBenefitController extends Controller
{
    public function index()
    {
        $benefit = Benefit::first();
        if ($benefit) {
            return view('moderator.benefit.list', compact('benefit'));
        }
    }
}
