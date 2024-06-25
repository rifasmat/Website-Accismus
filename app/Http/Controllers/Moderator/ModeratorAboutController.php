<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\About;


class ModeratorAboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        if ($about) {
            return view('moderator.about.list', compact('about'));
        }
    }
}
