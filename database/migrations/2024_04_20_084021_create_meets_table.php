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
            $table->dateTime('date_and_time')->nullable();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_online')->default(false);
            $table->boolean('is_confirmed')->default(false);
            $table->foreignId('duration_id')->nullable();
            $table->dateTime('first_date_and_time')->nullable();
            $table->dateTime('second_date_and_time')->nullable();
            $table->foreignId('user1_id');
            $table->foreignId('user2_id');
            $table->boolean('first_is_confirmed')->default(false);
            $table->boolean('second_is_confirmed')->default(false);
            $table->boolean('first_is_online')->nullable();
            $table->boolean('second_is_online')->nullable();
            $table->foreignId('first_duration_id')->nullable();
            $table->foreignId('second_duration_id')->nullable();
            $table->foreignId('first_feedback_meet_id')->nullable();
            $table->foreignId('second_feedback_meet_id')->nullable();
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
