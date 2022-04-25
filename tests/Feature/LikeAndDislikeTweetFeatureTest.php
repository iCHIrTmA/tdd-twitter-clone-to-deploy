<?php

namespace Tests\Feature;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeAndDislikeTweetFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_like_a_tweet(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // transfer to Like unit test
        $this->assertInstanceOf(HasMany::class, $user->likedTweets());

        $this->assertCount(0, $user->likedTweets);

        $this->actingAs($user)
            ->post(route('likes.store', [$tweet]));

        $this->assertCount(1, $user->fresh()->likedTweets);

        // transfer to Like unit test
        $this->assertInstanceOf(Like::class, $user->fresh()->likedTweets->first());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_tweet(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // like a tweet
        $this->actingAs($user)
            ->post(route('likes.store', [$tweet]));

        $this->assertCount(1, $user->likedTweets);

        // unlike a tweet
        $this->actingAs($user)
            ->delete(route('likes.destroy', [$tweet]));

        $this->assertCount(0, $user->fresh()->likedTweets);
    }

    /**
     * @test
     */
    public function a_user_can_dislike_a_tweet(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // transfer to Like unit test
        $this->assertInstanceOf(HasMany::class, $user->dislikedTweets());

        $this->assertCount(0, $user->dislikedTweets);

        $this->actingAs($user)
            ->post(route('dislikes.store', [$tweet]));

        $this->assertCount(1, $user->fresh()->dislikedTweets);

        // transfer to Dislike unit test
        $this->assertInstanceOf(Dislike::class, $user->fresh()->dislikedTweets->first());
    }

    /**
     * @test
     */
    public function a_user_can_undislike_a_tweet(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // dislike a tweet
        $this->actingAs($user)
            ->post(route('dislikes.store', [$tweet]));

        $this->assertCount(1, $user->dislikedTweets);

        // undislike a tweet
        $this->actingAs($user)
            ->delete(route('dislikes.destroy', [$tweet]));

        $this->assertCount(0, $user->fresh()->dislikedTweets);
    }

    /**
     * @test
     */
    public function disliking_a_tweet_automatically_unlikes_tweet_when_tweet_is_liked(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        $this->assertCount(0, $user->fresh()->likedTweets); 

        // like
        $this->actingAs($user)
            ->post(route('likes.store', [$tweet]));

        $this->assertCount(1, $user->fresh()->likedTweets); 

        // dislike
        $this->actingAs($user)
            ->post(route('dislikes.store', [$tweet]));

        $this->assertCount(0, $user->fresh()->likedTweets);
        $this->assertCount(1, $user->fresh()->dislikedTweets);

        // transfer to Dislike unit test
        $this->assertInstanceOf(Dislike::class, $user->fresh()->dislikedTweets->first());
    }

    /**
     * @test
     */
    public function liking_a_tweet_automatically_undislikes_tweet_when_tweet_is_disliked(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        $this->assertCount(0, $user->dislikedTweets); 

        // dislike
        $this->actingAs($user)
            ->post(route('dislikes.store', [$tweet]));

        $this->assertCount(1, $user->fresh()->dislikedTweets); 

        // like
        $this->actingAs($user)
            ->post(route('likes.store', [$tweet]));

        $this->assertCount(0, $user->fresh()->dislikedTweets);
        $this->assertCount(1, $user->fresh()->likedTweets);

        // transfer to Like unit test
        $this->assertInstanceOf(Like::class, $user->fresh()->likedTweets->first());
    }
}
