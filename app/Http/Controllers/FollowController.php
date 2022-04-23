<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    function store(User $user)
    {
        auth()->user()->toggleFollow($user);

        return back();
    }
}
