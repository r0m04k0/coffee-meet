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
        '1date_and_time',
        '2date_and_time',
        'user1_id',
        'user2_id',
        '1is_confirmed',
        '2is_confirmed',
        '1is_online',
        '2is_online',
        '1duration_id',
        '2duration_id',
        '1feedback_meet_id',
        '2feedback_meet_id',
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
        return $this->belongsTo(Duration::class, '1duration_id', 'id');
    }

    public function second_duration(): BelongsTo
    {
        return $this->belongsTo(Duration::class, '2duration_id', 'id');
    }

    public function final_duration()
    {
        return $this->belongsTo(Duration::class, 'duration_id', 'id');
    }
}
