<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;

class GuestDashboardController extends Controller
{
    public function index()
    {
        // team accismus
        $totalTeam = User::whereIn('role', ['Guild Leader', 'Humas', 'Senate', 'Moderator'])->count();

        // history rf accismus
        $totalHistory = History::count();

        // gallery accismus
        $totalGallery = Gallery::count();

        // member accismus
        $totalMember = User::whereIn('role', ['Member'])->count();

        return view(
            'guest.dashboard.list',
            compact(
                'totalTeam',
                'totalHistory',
                'totalGallery',
                'totalMember',
            )
        );
    }
}
