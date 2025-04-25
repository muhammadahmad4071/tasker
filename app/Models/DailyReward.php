<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReward extends Model
{
    protected $fillable = [
        'user_id',
        'progress',
        'claimed'
    ];


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
