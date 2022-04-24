<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExploreFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_auth_user_can_see_explore_page():void
    {
        $user = User::factory()->create();
        $another_user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('explore.index'))
            ->assertStatus(200)
            ->assertSee("Hi $user->username, Explore the Tweety World!")
            ->assertSee($another_user->username);
    }
}
