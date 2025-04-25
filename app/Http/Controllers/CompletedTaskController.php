<?php

namespace App\Http\Controllers;

use App\Models\CompletedTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompletedTaskController extends Controller
{
    public function store(Request $request, Task $task) {
        $watchTime = (int) $request->watch_time ?? 0;
        if ($watchTime < $task->time) {
            abort(403, "You did not watch the video for at least " . $task->time . " seconds");
        }

        $user = $request->user();

        CompletedTask::create([
            'user_id' => $user->id,
            'task_id' => $task->id
        ]);


        $streak = CompletedTask::getRecentStreak($user->id);
        $progress = '';
        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $progress .= $streak->contains($date) ? '1' : '0';
        }

        $progress = Str::reverse($progress);
        $dailyReward = $user->dailyReward;
        $dailyReward->progress = $progress;
        $dailyReward->save();

        $points = $user->points;
        $points->value += $task->reward;
        $points->total += $task->reward;
        $points->save();


        return redirect()->route('tasks.index');
    }
}
