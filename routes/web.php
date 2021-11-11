<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    $tasks = DB::table("tasks")->where("status", "=", 0)->orderBy('date_do')->get();
    return view('task.list', [
        "tasks" => $tasks
    ]);
});

Route::get('/tasks/new', function () {
    return view('task.new');
});

Route::get('/tasks/{id}/edit', function ($id) {
    $task = DB::table("tasks")->where("id", "=", $id)->first();
    return view('task.edit', [
        "task" => $task
    ]);
});

Route::get('/tasks/{id}/done', function ($id) {
    $task = DB::table("tasks")->where("id", "=", $id)->first();
    return view('task.done', [
        "task" => $task
    ]);
});

Route::get('/finished-list', function () {
    $tasks = DB::table("tasks")->whereIn("status", [1, 2])->orderBy('date_do')->get();
    return view('task.finished-list', [
        "tasks" => $tasks
    ]);
});

Route::get('/search', function () {
    $keyword = request()->get("keyword");
    $targetPeriod = request()->get("target-period");
    if ($targetPeriod == 'past') {
        $now = Carbon::now();
        $tasks = DB::table("tasks")->where("plan", "like", "%$keyword%")->where("date_do", "<=", $now)->orderBy('date_do')->get();
    } elseif ($targetPeriod == '') {
        $tasks = DB::table("tasks")->where("plan", "like", "%$keyword%")->orderBy('date_do')->get();
    }
    return view('task.search', [
        "tasks" => $tasks, "keyword" => $keyword
    ]);
});
