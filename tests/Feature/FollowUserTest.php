<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function userCanFollowOtherUsers()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $user->follow($anotherUser);

        $this->assertTrue($user->isFollowing($anotherUser));
    }

    /**
     * @test
     */
    public function userCanUnFollowOtherUsers()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $user->follow($anotherUser);

        $this->assertTrue($user->isFollowing($anotherUser));

        $user->unfollow($anotherUser);

        $this->assertFalse($user->isFollowing($anotherUser));
    }
}
