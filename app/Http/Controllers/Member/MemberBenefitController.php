<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Benefit;


class MemberBenefitController extends Controller
{
    public function index()
    {
        $benefit = Benefit::first();
        if ($benefit) {
            return view('member.benefit.list', compact('benefit'));
        }
    }
}
