<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class GuestTeamController extends Controller
{
    public function index()
    {
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];
        $users = User::whereIn('role', $includedRoles)
            ->orderByRaw("FIELD(role, 'Guild Leader', 'Humas', 'Senate', 'Moderator')")
            ->paginate(10);

        return view('guest.team.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $allowedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];

        $users = User::whereIn('role', $allowedRoles)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get();

        $administratorExists = User::where('role', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->exists();

        return view('guest.team.search', compact('users', 'search', 'administratorExists'));
    }
}
