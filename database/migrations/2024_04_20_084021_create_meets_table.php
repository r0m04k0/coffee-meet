<?php

use App\Models\Duration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_and_time');
            $table->boolean('is_done');
            $table->boolean('is_online');
            $table->boolean('is_confirmed');
            $table->foreignId('duration_id');
            $table->dateTime('1date_and_time');
            $table->dateTime('2date_and_time');
            $table->foreignId('user1_id');
            $table->foreignId('user2_id');
            $table->boolean('1is_confirmed');
            $table->boolean('2is_confirmed');
            $table->boolean('1is_online');
            $table->boolean('2is_online');
            $table->foreignId('1duration_id');
            $table->foreignId('2duration_id');
            $table->foreignId('1feedback_meet_id');
            $table->foreignId('2feedback_meet_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meets');
    }
};
