<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdministratorMemberController extends Controller
{
    public function index()
    {
        $includedRoles = ['Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader'];
        $users = User::whereIn('user_role', $includedRoles)
            ->orderByRaw("FIELD(user_role, 'Member', 'Moderator', 'Senate', 'Humas', 'Guild Leader')")
            ->paginate(10);

        return view('administrator.member.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $includedRoles = ['Guild Leader', 'Humas', 'Senate', 'Moderator', 'Member'];

        $users = User::whereIn('user_role', $includedRoles)
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%")
                    ->orWhere('user_email', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('administrator.member.search', compact('users'));
    }

    public function changeStatus($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->user_role = 'Guest';
        $user->save();

        return redirect()->route('administrator.request-member.list')
            ->with('changeStatus', "{$user->user_nama} Sudah Kembali Menjadi Guest.");
    }
}
