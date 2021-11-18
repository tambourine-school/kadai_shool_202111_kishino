<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskService
{

    public function getRunningTasks()
    {
        $tasks = DB::table("tasks")->where("status", "=", 0)->orderBy('date_do')->get();
        return $tasks;
    }

    public function getFinishedTasks()
    {
        $tasks = DB::table("tasks")->whereIn("status", [1, 2])->orderBy('date_do')->get();
        return $tasks;
    }

    public function getFirstTask($id)
    {
        $task = DB::table("tasks")->where("id", "=", $id)->first();
        return $task;
    }

    public function insertTask($payload)
    {
        DB::table("tasks")->insert($payload);
    }

    public function updateTask($id, $payload)
    {
        DB::table("tasks")->where("id", $id)->update($payload);
    }

    public function deleteTask($id)
    {
        DB::table("tasks")->where("id", $id)->delete();
    }

    public function getTasksByKeyword($keyword)
    {
        $tasks = DB::table("tasks")->where("plan", "like", "%$keyword%")->orderBy('date_do')->get();
        return $tasks;
    }

    public function getTasksByKeywordFromNow($keyword)
    {
        $now = Carbon::now();
        $tasks = DB::table("tasks")->where("plan", "like", "%$keyword%")->where("date_do", "<=", $now)->orderBy('date_do')->get();
        return $tasks;
    }
}
