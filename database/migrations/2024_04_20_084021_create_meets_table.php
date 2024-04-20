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
            $table->dateTime('1date_and_time')->nullable();
            $table->dateTime('2date_and_time')->nullable();
            $table->foreignId('user1_id');
            $table->foreignId('user2_id');
            $table->boolean('1is_confirmed')->default(false);
            $table->boolean('2is_confirmed')->default(false);
            $table->boolean('1is_online')->nullable();
            $table->boolean('2is_online')->nullable();
            $table->foreignId('1duration_id')->nullable();
            $table->foreignId('2duration_id')->nullable();
            $table->foreignId('1feedback_meet_id')->nullable();
            $table->foreignId('2feedback_meet_id')->nullable();
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
