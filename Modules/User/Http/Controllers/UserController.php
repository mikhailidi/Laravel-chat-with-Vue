<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\User\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user::profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function getAllUsers()
    {
        $users = User::where('id', '!=', Auth::user()->getId())
            ->paginate(14);

        return view('user::all', [
            'users' => $users
        ]);
    }
}
