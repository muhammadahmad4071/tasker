<?php

namespace App\Http\Controllers;

use App\Models\CompletedTask;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index() {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admins get all tasks
            $tasks = Task::all();
        } else {
            // Users get tasks they haven't completed yet
            $completedTaskIds = CompletedTask::where('user_id', $user->id)
                ->pluck('task_id');

            $tasks = Task::whereNotIn('id', $completedTaskIds)->get();
        }
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function show(Request $request, Task $task) {
        if ($task->type === 'video') {
            return view('tasks.show-video', ['task' => $task]);
        }
        if ($task->type === 'website') {
            return view('tasks.show-website', ['task' => $task]);
        }

        return abort(404, "Task type " . $task->type . " not found!");
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:4000',
            'time' => 'required|integer|gt:0',
            'reward' => 'required|numeric|gte:0.1',
            'type' => 'required|in:video,website',
            'link' => 'required|url'
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index');
    }

    public function edit(Request $request, Task $task) {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:4000',
            'time' => 'required|integer|gt:0',
            'reward' => 'required|numeric|gte:0.1',
            'type' => 'required|in:video,website',
            'link' => 'required|url'
        ]);

        $task->update($validated);

        return back()->with('status', 'task-updated');
    }

    public function destroy(Request $request, Task $task) {
        $task->delete();
        return back();
    }
}
