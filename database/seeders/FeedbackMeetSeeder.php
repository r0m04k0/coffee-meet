<?php

namespace Database\Seeders;

use App\Models\FeedbackMeet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackMeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(0, 20) as $range) {
            FeedbackMeet::create([
                'review' => fake()->realText(),
                'rating' => fake()->numberBetween(1, 5),
             ]);
        }
    }
}
