<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return redirect('/tasks');
});

Route::get('/tasks', function () {
    $tasks = DB::table("tasks")->get();
    return view('task.list', [
        "tasks" => $tasks
    ]);
});

Route::get('/tasks/new', function () {
    $tasks = DB::table("tasks")->get();
    return view('task.new', [
        "tasks" => $tasks
    ]);
});

Route::get('/tasks/{id}/edit', function ($id) {
    $task = DB::table("tasks")->where("id", "=", $id)->get();
    return view('task.edit', [
        "task" => $task
    ]);
});

Route::get('/tasks/{id}/done', function ($id) {
    $task = DB::table("tasks")->where("id", "=", $id)->get();
    return view('task.done', [
        "task" => $task
    ]);
});

Route::get('/finished-list', function () {
    $tasks = DB::table("tasks")->where("status", "!=", '実行中')->get();
    return view('task.finished-list', [
        "tasks" => $tasks
    ]);
});
