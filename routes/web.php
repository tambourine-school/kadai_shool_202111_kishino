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

Route::get('/', [\App\Http\Controllers\TaskController::class, "getTop"]);
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, "getList"]);
Route::get('/tasks/new', [\App\Http\Controllers\TaskController::class, "getNew"]);
Route::get('/tasks/{id}/edit', [\App\Http\Controllers\TaskController::class, "getEdit"]);
Route::get('/tasks/{id}/done', [\App\Http\Controllers\TaskController::class, "getDone"]);
Route::get('/finished-list', [\App\Http\Controllers\TaskController::class, "getFinishedList"]);
Route::get('/search', [\App\Http\Controllers\TaskController::class, "getSearch"]);
