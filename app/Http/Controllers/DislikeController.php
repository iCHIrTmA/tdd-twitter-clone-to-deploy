<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        if ($tweet->isLiked()) {
            auth()->user()->unlike($tweet);
        }

        auth()->user()->dislike($tweet);

        return back();
    }   

    public function destroy(Tweet $tweet)
    {
        auth()->user()->undislike($tweet);

        return back();
    }
}
