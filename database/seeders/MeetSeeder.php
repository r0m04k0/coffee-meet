<?php

namespace Database\Seeders;

use App\Models\Duration;
use App\Models\FeedbackMeet;
use App\Models\Meet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Meet::create([
                 'date_and_time' => Carbon::now(),
                 'is_done' => fake()->boolean(),
                 'is_online' => fake()->boolean(),
                 'is_confirmed' => fake()->boolean(),
                 'duration_id' => Duration::inRandomOrder()->first('id')->id,
                 '1date_and_time' => Carbon::now(),
                 '2date_and_time' => Carbon::now(),
                 'user1_id' => User::inRandomOrder()->first('id')->id,
                 'user2_id' => User::inRandomOrder()->first('id')->id,
                 '1is_confirmed' => fake()->boolean(),
                 '2is_confirmed' => fake()->boolean(),
                 '1is_online' => fake()->boolean(),
                 '2is_online' => fake()->boolean(),
                 '1duration_id' => Duration::inRandomOrder()->first('id')->id,
                 '2duration_id' => Duration::inRandomOrder()->first('id')->id,
                 '1feedback_meet_id' => FeedbackMeet::inRandomOrder()->first('id')->id,
                 '2feedback_meet_id' => FeedbackMeet::inRandomOrder()->first('id')->id
             ]);
        }
    }
}
