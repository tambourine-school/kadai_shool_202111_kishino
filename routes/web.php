<?php

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

Route::get('/', [\App\Http\Controllers\TaskController::class, "getTopPage"]);
Route::get('/tasks/doing/{page}', [\App\Http\Controllers\TaskController::class, "getTasksPage"]);
Route::get('/tasks/new', [\App\Http\Controllers\TaskController::class, "getNewTaskPage"]);
Route::get('/tasks/{id}/edit', [\App\Http\Controllers\TaskController::class, "getEditTaskPage"]);
Route::get('/tasks/{id}/done', [\App\Http\Controllers\TaskController::class, "getDoneTaskPage"]);
Route::get('/finished-list', [\App\Http\Controllers\TaskController::class, "getFinishedTaskPage"]);
Route::get('/search', [\App\Http\Controllers\TaskController::class, "getSearchPage"]);

Route::post('/tasks/new', [\App\Http\Controllers\TaskController::class, "postNewTask"]);
Route::post('/tasks/{id}/edit', [\App\Http\Controllers\TaskController::class, "postEditTask"]);
Route::post('/tasks/{id}/delete', [\App\Http\Controllers\TaskController::class, "postDeleteTask"]);
Route::post('/tasks/{id}/done', [\App\Http\Controllers\TaskController::class, "postDoneTask"]);
