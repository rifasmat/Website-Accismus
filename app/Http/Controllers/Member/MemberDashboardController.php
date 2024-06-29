<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;

class MemberDashboardController extends Controller
{
    public function index()
    {
        // team accismus
        $totalTeam = User::whereIn('user_role', ['Guild Leader', 'Humas', 'Senate', 'Moderator'])->count();

        // history rf accismus
        $totalHistory = History::count();

        // gallery accismus
        $totalGallery = Gallery::count();

        // member accismus
        $totalMember = User::whereIn('user_role', ['Member'])->count();

        return view(
            'member.dashboard.list',
            compact(
                'totalTeam',
                'totalHistory',
                'totalGallery',
                'totalMember',
            )
        );
    }
}
