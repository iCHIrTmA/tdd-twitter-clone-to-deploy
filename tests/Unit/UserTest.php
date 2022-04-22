<?php

namespace Tests\Unit;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function aUserTimelineShowsUserTweets()
    {
        $user = User::factory()
                    ->has(Tweet::factory(2))
                    ->create();
        
        $this->assertCount(2, $user->timeline());
    }

    /**
     * @test
     */
    public function aUserCanFollowOtherUsers()
    {
        $user = User::factory()
                    ->create();

        $userAToFollow = User::factory()
                            ->has(Tweet::factory(2))
                            ->create();

        $user->follow($userAToFollow);
        
        $this->assertCount(1, $user->follows);

        $userBToFollow = User::factory()
                            ->has(Tweet::factory(2))
                            ->create();

        $user->follow($userBToFollow);

        $this->assertCount(2, $user->fresh()->follows);
    }
}
