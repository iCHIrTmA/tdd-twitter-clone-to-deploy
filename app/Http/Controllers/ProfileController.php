<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {    
        return view('profiles.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->has('avatar')) {
            $user->update([
                'avatar' => $request->avatar->store('avatars'),
            ]);
        }


        return view('profiles.show', [
            'user' => $user
        ]);
    }
}
