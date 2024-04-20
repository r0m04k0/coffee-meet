<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meet extends Model
{
    use HasFactory;

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
