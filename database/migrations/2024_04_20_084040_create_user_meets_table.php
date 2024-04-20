<?php

use App\Models\Duration;
use App\Models\FeedbackMeet;
use App\Models\Meet;
use App\Models\User;
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
        Schema::create('user_meets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Meet::class);
            $table->foreignIdFor(FeedbackMeet::class);
            $table->foreignIdFor(Duration::class);
            $table->boolean('is_confirmed');
            $table->boolean('is_online');
            $table->dateTime('date_and_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_meets');
    }
};
