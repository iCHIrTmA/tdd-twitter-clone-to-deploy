<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilePageTest extends TestCase
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
    public function aUserCanVisitHisOwnProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profiles.show', $user));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function aUserCanSeeEditButtonOnHisOwnProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profiles.show', $user));

        $response->assertSee('Edit Profile');
    }

    /**
     * @test
     */
    public function aUserCannotSeeEditButtonOnOtherUserProfile()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profiles.show', $anotherUser));

        $response->assertDontSee('Edit Profile');
    }

    /**
     * @test
     */
    public function aUserCanAccessEditPageOfHisOwnProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profiles.edit', $user));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function aUserCannotAccessEditPageOfOtherUserProfile()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profiles.edit', $otherUser));

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function aUserCanEditHisOwnProfile()
    {
        $user = User::factory()->create();
        $newDetails = ['username' => 'new_user_name', 'name' => 'New Name', 'email' => 'new_email@example.net'];

        $response = $this->actingAs($user)->patch(route('profiles.update', $user), $newDetails);

        $response->assertStatus(200);
        $this->assertSame($user->fresh()->username, $newDetails['username']);
        $this->assertSame($user->fresh()->name, $newDetails['name']);
    }
}
