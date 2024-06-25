<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Informasi;
use App\Models\Benefit;
use App\Models\Gallery;
use App\Models\History;
use App\Models\User;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        // informasi accismus
        $totalInformasi = Informasi::count();

        // about accismus
        $totalAbout = About::count();

        // benefit accismus
        $totalBenefit = Benefit::count();

        // team accismus
        $totalTeam = User::whereIn('user_role', ['Guild Leader', 'Humas', 'Senate', 'Moderator'])->count();

        // history rf accismus
        $totalHistory = History::count();

        // gallery accismus
        $totalGallery = Gallery::count();

        // member accismus
        $totalMember = User::whereIn('user_role', ['Member'])->count();

        // guest accismus
        $totalGuest = User::whereIn('user_role', ['Guest'])->count();

        return view(
            'moderator.dashboard.list',
            compact(
                'totalInformasi',
                'totalAbout',
                'totalBenefit',
                'totalTeam',
                'totalHistory',
                'totalGallery',
                'totalMember',
                'totalGuest',
            )
        );
    }
}
