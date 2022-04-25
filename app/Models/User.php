<?php

namespace App\Models;

use App\Traits\Followable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Tests\Feature\LikeAndDislikeTweetFeatureTest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value)
    {
        return $value ? asset('storage/'. $value) : "https://i.pravatar.cc/200?u=" . $this->email;
        // return "https://i.pravatar.cc/200?u=" . $this->email;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function timeline(): Collection
    {
        $followedUsers = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $followedUsers)
                    ->orWhere('user_id', $this->id)
                    ->latest()
                    ->get();
    }

    public function likedTweets(): HasMany
    {
        return $this->hasMany(Like::class)->latest();
    }

    public function like($tweet)
    {
        $this->likedTweets()->create(['tweet_id' => $tweet->id]);
    }

    public function unlike($tweet)
    {
        $this->likedTweets()->where('tweet_id', $tweet->id)->delete();
    }

    public function dislikedTweets(): HasMany
    {
        return $this->hasMany(Dislike::class)->latest();
    }

    public function dislike($tweet)
    {
        $this->dislikedTweets()->create(['tweet_id' => $tweet->id]);
    }

    public function undislike($tweet)
    {
        $this->dislikedTweets()->where('tweet_id', $tweet->id)->delete();
    }
}
