<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::get();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
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
            'video' => 'required|url'
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
            'video' => 'required|url'
        ]);

        $task->update($validated);

        return back()->with('status', 'task-updated');
    }

    public function destroy(Request $request, Task $task) {
        $task->delete();
        return back();
    }
}
