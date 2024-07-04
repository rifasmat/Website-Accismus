<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MemberTeamController extends Controller
{
    public function index()
    {
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];
        $users = User::whereIn('role', $includedRoles)
            ->orderByRaw("FIELD(role, 'Guild Leader', 'Humas', 'Senate', 'Moderator')")
            ->paginate(10);

        return view('member.team.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $allowedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator'];

        $users = User::whereIn('role', $allowedRoles)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get();

        $administratorExists = User::where('role', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->exists();

        return view('member.team.search', compact('users', 'search', 'administratorExists'));
    }
}
