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

Route::get('/', [\App\Http\Controllers\TaskController::class, "getTop"]);
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, "getList"]);
Route::get('/tasks/new', [\App\Http\Controllers\TaskController::class, "getNew"]);
Route::get('/tasks/{id}/edit', [\App\Http\Controllers\TaskController::class, "getEdit"]);
Route::get('/tasks/{id}/done', [\App\Http\Controllers\TaskController::class, "getDone"]);
Route::get('/finished-list', [\App\Http\Controllers\TaskController::class, "getFinishedList"]);
Route::get('/search', [\App\Http\Controllers\TaskController::class, "getSearch"]);

Route::post('/tasks/new', function () {
    $payload = [
        "plan" => request()->get("plan"),
        "date_do" => request()->get("date_do"),
        "status" => 0,
        "created_at" => Carbon::now(),
    ];
    $rules = [
        "plan" => ["required", "max:20"],
        "date_do" => ["required"],
    ];
    $val = validator($payload, $rules);
    if ($val->fails()) {
        session()->flash("old_form", $payload);
        session()->flash("errors", $val->errors()->toArray());
        return redirect("/tasks/new");
    }
    DB::table("tasks")->insert($payload);
    return redirect("/tasks");
});
