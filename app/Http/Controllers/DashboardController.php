<?php

namespace App\Http\Controllers;

use App\Models\CompletedTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $nlTimezone = 'Europe/Amsterdam';
        $start = Carbon::now($nlTimezone)->startOfDay()->timezone('UTC');
        $end = Carbon::now($nlTimezone)->endOfDay()->timezone('UTC');
        $user = $request->user();
        $points = $user->points;
        $completedTasks = Task::whereHas('completedBy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $completedTaskIds = CompletedTask::where('user_id', $user->id)
            ->pluck('task_id');

        $pending = Task::whereNotIn('id', $completedTaskIds)->whereBetween('created_at', [$start, $end])->get();

        $todaysCompleted = Task::whereHas('completedBy', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereBetween('created_at', [$start, $end])->get();
        return view('dashboard', ['points' => $points, 'totalCompletedTasks' => $completedTasks, 'completedTasks' => $todaysCompleted, 'pendingTasks' => $pending]);
    }
}
