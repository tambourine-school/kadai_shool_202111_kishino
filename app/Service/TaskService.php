<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskService
{

    public function getRunningTasksPerTen($page)
    {
        $tasks = DB::table("tasks")->where("status", "=", 0)->orderBy('date_do')->skip(($page - 1) * 10)->take(10)->get();
        return $tasks;
    }

    public function getRunningTasksNumber()
    {
        $number = DB::table("tasks")->where("status", "=", 0)->orderBy('date_do')->count();
        return $number;
    }

    public function getFinishedTasks()
    {
        $tasks = DB::table("tasks")->whereIn("status", [1, 2])->orderBy('date_do')->get();
        return $tasks;
    }

    public function getFirstTaskByHashedId($hashedId)
    {
        $task = DB::table("tasks")->where("hashed_id", "=", $hashedId)->first();
        return $task;
    }

    public function insertTask($payload)
    {
        DB::table("tasks")->insert($payload);
    }

    public function updateTask($hashedId, $payload)
    {
        DB::table("tasks")->where("hashed_id", $hashedId)->update($payload);
    }

    public function deleteTask($hashedId)
    {
        DB::table("tasks")->where("hashed_id", $hashedId)->delete();
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
