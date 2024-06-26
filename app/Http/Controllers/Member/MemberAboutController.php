<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\About;


class MemberAboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        if ($about) {
            return view('member.about.list', compact('about'));
        }
    }
}
