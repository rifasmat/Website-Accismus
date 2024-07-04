<?php

namespace App\Http\Controllers\Senate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SenateMemberController extends Controller
{
    public function index()
    {
        $includedRoles = ['Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader'];
        $users = User::whereIn('role', $includedRoles)
            ->orderByRaw("FIELD(role, 'Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader')")
            ->paginate(10);

        return view('senate.member.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::where('role', '!=', 'Administrator')
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

        return view('senate.member.search', compact('users', 'search', 'administratorExists'));
    }

    public function changeStatus($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->role = 'Guest';
        $user->save();

        return redirect()->route('senate.request-member.list')
            ->with('changeStatus', "{$user->nama} Sudah Kembali Menjadi Guest.");
    }
}
