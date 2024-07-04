<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Informasi;
use App\Models\Benefit;
use App\Models\Gallery;
use App\Models\History;
use App\Models\Broadcast;
use App\Models\User;

class AdministratorDashboardController extends Controller
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

        // Administrator accismus
        $totalAdministrator = User::where('role', 'Administrator')->count();

        // guild leader accismus
        $totalGuildLeader = User::where('role', 'Guild Leader')->count();

        // humas accismus
        $totalHumas = User::where('role', 'Humas')->count();

        // senate accismus
        $totalSenate = User::where('role', 'Senate')->count();

        // moderator accismus
        $totalModerator = User::where('role', 'Moderator')->count();

        return view(
            'administrator.dashboard.list',
            compact(
                'totalInformasi',
                'totalAbout',
                'totalBenefit',
                'totalTeam',
                'totalHistory',
                'totalGallery',
                'totalBroadcast',
                'totalPengguna',
                'totalAdministrator',
                'totalHumas',
                'totalSenate',
                'totalModerator',
                'totalMember',
                'totalGuest',
                'totalGuildLeader'
            )
        );
    }
}
