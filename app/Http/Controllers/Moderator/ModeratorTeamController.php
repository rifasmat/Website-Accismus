<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ModeratorTeamController extends Controller
{
    public function index()
    {
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];
        $users = User::whereIn('user_role', $includedRoles)
            ->orderByRaw("FIELD(user_role, 'Guild Leader', 'Humas', 'Senate', 'Moderator')")
            ->paginate(10);

        return view('moderator.team.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];

        $users = User::whereIn('user_role', $includedRoles)
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%")
                    ->orWhere('user_email', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('moderator.team.search', compact('users'));
    }
}
