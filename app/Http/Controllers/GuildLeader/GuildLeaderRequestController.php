<?php

namespace App\Http\Controllers\GuildLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class GuildLeaderRequestController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Guest')->paginate(10);

        return view('guildleader.request-member.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $includedRoles = ['Guest'];

        $users = User::whereIn('role', $includedRoles)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('guildleader.request-member.search', compact('users'));
    }

    public function changeStatus($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->role = 'Member';
        $user->save();

        return redirect()->route('guildleader.member.list')
            ->with('changeStatus', "{$user->nama} Sudah Menjadi Member.");
    }
}
