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
        $completedTaskIds = CompletedTask::where('user_id', $user->id)
            ->pluck('task_id');
        $totalCount = Task::count();

        $pending = Task::whereNotIn('id', $completedTaskIds)->whereBetween('created_at', [$start, $end])->get();
        $completed = Task::whereIn('id', $completedTaskIds)->whereBetween('created_at', [$start, $end])->get();

        $chartData = $user->tasks->map(function ($item) {
            return [
                'date' => Carbon::parse($item->date)->format('M d'), // or 'Y-m-d'
                'count' => $item->count
            ];
        });

        $completedTasks = CompletedTask::where('user_id', $user->id)
            ->with('task')
            ->get();

        // 2. Group by date and sum rewards
        $earningsByDate = $completedTasks->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->toDateString(); // 'YYYY-MM-DD'
        })->map(function ($items) {
            return $items->sum(fn($item) => $item->task->reward);
        });

        // 3. Determine date range
        $startC = $completedTasks->min('created_at') ?? now();
        $endC = $completedTasks->max('created_at') ?? now();

        $startC = Carbon::parse($startC)->startOfDay();
        $endC = Carbon::parse($endC)->endOfDay();

        // 4. Fill missing dates
        $fullDateRange = collect();
        $date = $startC->copy();
        while ($date->lte($endC)) {
            $dateString = $date->toDateString();
            $fullDateRange->put($dateString, $earningsByDate->get($dateString, 0));
            $date->addDay();
        }

        $chartData = [
            'labels' => $fullDateRange->keys(),
            'data' => $fullDateRange->values(),
        ];

        return view('dashboard', [
            'points' => $points,
            'totalPending' => $totalCount - $completedTaskIds->count(),
            'pendingTasks' => $pending,
            'completedTasks' => $completed,
            'chartData' => $chartData
        ]);
    }
}
