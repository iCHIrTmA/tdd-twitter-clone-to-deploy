<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function __invoke()
    {
        $users = User::paginate(29);
        
        return view('explore.index', [
            'users' => $users
        ]);
    }
}
