<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'video',
        'reward',
        'time',
    ];

    public function isCompleted(User $user) {
        $completedTask = CompletedTask::where([
            'user_id' => $user->id,
            'task_id' => $this->id
        ])->exists();

        return $completedTask;
    }

    public function completedBy(): HasMany {
        return $this->hasMany(CompletedTask::class);
    }
}
