<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        auth()->user()->like($tweet);

        return back();
    }   

    public function destroy(Tweet $tweet)
    {
        auth()->user()->unlike($tweet);

        return back();
    }
}
