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
                 'first_date_and_time' => Carbon::now(),
                 'second_date_and_time' => Carbon::now(),
                 'user1_id' => User::inRandomOrder()->first('id')->id,
                 'user2_id' => User::inRandomOrder()->first('id')->id,
                 'first_is_confirmed' => fake()->boolean(),
                 'second_is_confirmed' => fake()->boolean(),
                 'first_is_online' => fake()->boolean(),
                 'second_is_online' => fake()->boolean(),
                 'first_duration_id' => Duration::inRandomOrder()->first('id')->id,
                 'second_duration_id' => Duration::inRandomOrder()->first('id')->id,
                 'first_feedback_meet_id' => FeedbackMeet::inRandomOrder()->first('id')->id,
                 'second_feedback_meet_id' => FeedbackMeet::inRandomOrder()->first('id')->id
             ]);
        }
    }
}
