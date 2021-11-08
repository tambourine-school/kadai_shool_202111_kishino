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

// Route::get('/tasks', function () {
//     return view('task.list');
// });

Route::get('/tasks', function () {
    $tasks = DB::table("tasks")->get();
    return view('task.list', [
        "tasks" => $tasks
    ]);
});

Route::get('/tasks/new', function () {
    return view('task.new');
});

Route::get('/tasks/{id}/edit', function () {
    return view('task.edit');
});

Route::get('/tasks/{id}/done', function () {
    return view('task.done');
});

Route::get('/finished-list', function () {
    return view('task.finished-list');
});
