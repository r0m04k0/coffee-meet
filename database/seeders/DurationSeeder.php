<?php

namespace Database\Seeders;

use App\Models\Duration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $durations = [
            '10 минут',
            '15 минут',
            '30 минут'
        ];

        foreach ($durations as $duration) {
            $durationsIds = Duration::updateOrCreate(['duration' => $duration]);
        }
    }
}
