<?php

namespace App\Http\Controllers;

use App\Models\CompletedTask;
use App\Models\Task;
use Illuminate\Http\Request;

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

        $points = $user->points;
        $points->value += $task->reward;
        $points->total += $task->reward;
        $points->save();

        return redirect()->route('tasks.index');
    }
}
