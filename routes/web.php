<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
const TASKS_ID = 'tasks/{id}';
const TASK_TYPES_ID = 'task-types/{id}';

Route::get('/', function () {
    return view('welcome');
});

Route::get('tasks', [TaskController::class, 'index']);
Route::get(TASKS_ID, [TaskController::class, 'show']);
Route::put(TASKS_ID, [TaskController::class, 'update']);
Route::post(TASKS_ID . '/finish', [TaskController::class, 'finish']);
Route::post('tasks', [TaskController::class, 'store']);
Route::delete(TASKS_ID, [TaskController::class, 'delete']);

Route::get('task-types', [TaskTypeController::class, 'index']);
Route::get(TASK_TYPES_ID, [TaskTypeController::class, 'show']);
Route::put(TASK_TYPES_ID, [TaskTypeController::class, 'update']);
Route::post('task-types', [TaskTypeController::class, 'store']);
Route::delete(TASK_TYPES_ID, [TaskTypeController::class, 'delete']);

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
