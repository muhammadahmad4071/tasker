<?php

use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    $points = $request->user()->points;
    return view('dashboard', ['points' => $points]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(TaskController::class)
        ->name('tasks.')
        ->prefix('tasks')
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::middleware(['role:Admin'])
                ->group(function() {
                    Route::get('/create', 'create')->name('create');
                    Route::post('/create', 'store');
                    Route::get('/{task}/edit', 'edit')->name('edit');
                    Route::put('/{task}', 'update');
                    Route::delete('/{task}', 'destroy')->name('delete');
                });

            Route::get('/{task}', 'show')->name('show');
        });

    Route::controller(CompletedTaskController::class)
        ->name('completed-tasks.')
        ->prefix('completed-tasks')
        ->group(function () {
            Route::post('/{task}', 'store')->name('create');
        });
});

require __DIR__.'/auth.php';
