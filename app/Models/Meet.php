<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_and_time',
        'is_done',
        'is_online',
        'is_confirmed',
        'duration_id',
        'first_date_and_time',
        'second_date_and_time',
        'user1_id',
        'user2_id',
        'first_is_confirmed',
        'second_is_confirmed',
        'first_is_online',
        'second_is_online',
        'first_duration_id',
        'second_duration_id',
        'first_feedback_meet_id',
        'second_feedback_meet_id',
    ];

    public function first_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user1_id', 'id');
    }

    public function second_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user2_id', 'id');
    }

    public function first_duration(): BelongsTo
    {
        return $this->belongsTo(Duration::class, 'first_duration_id', 'id');
    }

    public function second_duration(): BelongsTo
    {
        return $this->belongsTo(Duration::class, 'second_duration_id', 'id');
    }

    public function final_duration()
    {
        return $this->belongsTo(Duration::class, 'duration_id', 'id');
    }
}
