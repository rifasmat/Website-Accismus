<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MemberMemberController extends Controller
{
    public function index()
    {
        $includedRoles = ['Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader'];
        $users = User::whereIn('user_role', $includedRoles)
            ->orderByRaw("FIELD(user_role, 'Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader')")
            ->paginate(10);

        return view('member.member.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::where('user_role', '!=', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%");
            })
            ->get();

        $administratorExists = User::where('user_role', 'Administrator')
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%");
            })
            ->exists();

        return view('member.member.search', compact('users', 'search', 'administratorExists'));
    }
}
