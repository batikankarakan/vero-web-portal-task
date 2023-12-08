<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [\App\Http\Controllers\TasksController::class, 'tasks']);
Route::get('/tasks', [\App\Http\Controllers\TasksController::class, 'fetchTasks'])->name('fetch');
Route::get('/auth', [\App\Http\Controllers\TasksController::class, 'auth']);


