<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Followable
{
    public function follow(User $userToFollow)
    {
        return $this->follows()->attach($userToFollow);
    }

    public function unfollow(User $userToUnFollow)
    {
        return $this->follows()->detach($userToUnFollow);
    }

    public function toggleFollow(User $user)
    {
        return $this->follows()->toggle($user);
    }

    public function isFollowing(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

}