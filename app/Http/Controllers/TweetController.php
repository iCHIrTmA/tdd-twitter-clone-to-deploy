<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $tweets = auth()->user()->timeline();
        } else {
            $tweets = Tweet::all();
        }

        return view('tweets.index', [
            'tweets' => $tweets,
        ]);
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate(['body' => 'required|max:255']);

        auth()->user()->tweets()->create($validatedRequest);

        return redirect()->route('home');
    }
}
