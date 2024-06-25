<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ModeratorRequestController extends Controller
{
    public function index()
    {
        $users = User::where('user_role', 'Guest')->paginate(10);

        return view('moderator.request-member.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $includedRoles = ['Guest'];

        $users = User::whereIn('user_role', $includedRoles)
            ->where(function ($query) use ($search) {
                $query->where('user_nama', 'LIKE', "%{$search}%")
                    ->orWhere('user_username', 'LIKE', "%{$search}%")
                    ->orWhere('user_email', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('moderator.request-member.search', compact('users'));
    }

    public function changeStatus($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->user_role = 'Member';
        $user->save();

        return redirect()->route('moderator.member.list')
            ->with('changeStatus', "{$user->user_nama} Sudah Menjadi Member.");
    }
}
