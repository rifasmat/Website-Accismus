<?php

namespace App\Http\Controllers\GuildLeader;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Informasi;
use App\Models\Benefit;
use App\Models\Gallery;
use App\Models\History;
use App\Models\Broadcast;
use App\Models\User;

class GuildLeaderDashboardController extends Controller
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
        $totalTeam = User::whereIn('role', ['Guild Leader', 'Humas', 'Senate', 'Moderator'])->count();

        // history rf accismus
        $totalHistory = History::count();

        // gallery accismus
        $totalGallery = Gallery::count();

        // broadcast email accismus
        $totalBroadcast = Broadcast::count();

        // member accismus
        $totalMember = User::whereIn('role', ['Member'])->count();

        // guest accismus
        $totalGuest = User::whereIn('role', ['Guest'])->count();

        // pengguna accismus
        $totalPengguna = User::count();

        return view(
            'guildleader.dashboard.list',
            compact(
                'totalInformasi',
                'totalAbout',
                'totalBenefit',
                'totalTeam',
                'totalHistory',
                'totalGallery',
                'totalBroadcast',
                'totalPengguna',
                'totalMember',
                'totalGuest',
            )
        );
    }
}
