<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class CompletedTask extends Model
{
    protected $fillable = [
        'task_id',
        'user_id'
    ];

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public static function getRecentStreak($userId): Collection {
        // Get the tasks the user completed in the last 10 days
        $tasks = CompletedTask::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(10))
            ->orderBy('created_at', 'desc')
            ->get();

        // Initialize the streak collection and variables
        $streak = collect();
        $previousDate = null;

        // Group tasks by date
        $groupedByDate = $tasks->groupBy(function ($task) {
            return Carbon::parse($task->created_at)->toDateString(); // 'Y-m-d'
        });

        // Loop through the tasks and calculate the streak
        foreach ($groupedByDate as $date => $tasksOnDate) {
            // Get the number of tasks created on this date
            $taskCount = Task::whereDate('created_at', $date)->count();

            // Check if the user completed all tasks for this date
            $completedTaskCount = $tasksOnDate->count();

            // If the user didn't complete all tasks for the day, break the streak
            if ($taskCount !== $completedTaskCount) {
                // If a gap of 2+ days is found, break the streak
                if ($previousDate) {
                    $diff = Carbon::parse($previousDate)->diffInDays($date);
                    if (abs($diff) >= 2) {
                        $user = User::find($userId);
                        $dailyReward = $user->dailyReward;
                        $dailyReward->claimed = '0000000000';  // Reset the claimed counter
                        $dailyReward->save();
                        break;
                    }
                }
                // The user didn't complete all tasks for this day, so break
                break;
            }

            // Add the date to the streak
            $streak->push($date);

            // Update the previous date for gap calculation
            $previousDate = $date;
        }

        // Return the streak dates in ascending order
        return $streak->sort();
    }
}
