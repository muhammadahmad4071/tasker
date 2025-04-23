<?php

use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
                    Route::put('/{task}/edit', 'update');
                    Route::delete('/{task}', 'destroy')->name('delete');
                });

            Route::get('/{task}', 'show')->name('show');
        });

    Route::controller(OrderController::class)
        ->name('orders.')
        ->prefix('orders')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store');
            Route::delete('/{order}', 'destroy')->name('delete');
            Route::patch('/{order}/status', 'updateStatus')->name('updateStatus');
        });

    Route::controller(CompletedTaskController::class)
        ->name('completed-tasks.')
        ->prefix('completed-tasks')
        ->group(function () {
            Route::post('/{task}', 'store')->name('create');
        });

    Route::middleware(['role:Admin'])
        ->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
        });
});

require __DIR__.'/auth.php';
