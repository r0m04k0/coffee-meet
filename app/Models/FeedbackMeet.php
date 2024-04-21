<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackMeet extends Model
{
    protected $fillable = [
        'review',
        'rating'
    ];

    use HasFactory;
}
