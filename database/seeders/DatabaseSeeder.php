<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['email' => 'test_user@example.net']);

        $users = User::factory()->count(7)->create();

        foreach(range(1, 7) as $index) {
            Tweet::factory()->create(['user_id' => $users->random()]);
        }

        foreach($users as $user) {
            Like::factory()->create(['user_id' => $user, 'tweet_id' => Tweet::all()->random()]);
        }
    }
}
