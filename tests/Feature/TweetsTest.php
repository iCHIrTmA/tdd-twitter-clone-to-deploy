<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function userTweetsAreDisplayedInHomePage()
    {
        $user = User::factory()->create();
        $tweets = Tweet::factory(2)->for($user)->create();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);

        $response->assertSee($tweets->first()->user->name);
        $response->assertSee($tweets->first()->body);
        $response->assertSee($tweets->last()->user->name);
        $response->assertSee($tweets->last()->body);
    }

        /**
     * @test
     */
    public function userCanPublishTweets()
    {
        $user = User::factory()->create();
        $tweet = ['body' => 'hello'];

        $response = $this->actingAs($user)->post(route('tweets.store'), $tweet);
        $response->assertRedirect(route('home'));
    }
}
