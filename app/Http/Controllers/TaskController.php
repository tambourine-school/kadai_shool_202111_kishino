<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController
{
    public function getTop()
    {
        return redirect('/tasks');
    }

    public function getList()
    {
        $tasks = DB::table("tasks")->where("status", "=", 0)->orderBy('date_do')->get();
        return view('task.list', [
            "tasks" => $tasks
        ]);
    }

    public function getNew()
    {
        return view('task.new');
    }

    public function getEdit($id)
    {
        echo '' . 'hoge'; // hoge
        echo '' . (int)'hoge'; // 0
        echo (int)'hoge'; // 0
        echo gettype(1 . 1); // string
        echo 1 . 1; // '11'
        if ($id === "" . (int)$id && DB::table("tasks")->where("id", "=", "$id")->exists()) {
            return view('task.edit', [
                "task" => $this->getFirstTask($id)
            ]);
        } else {
            return redirect('/tasks');
        }
    }

    public function getDone($id)
    {
        return view('task.done', [
            "task" => $this->getFirstTask($id)
        ]);
    }

    public function getFinishedList()
    {
        $tasks = DB::table("tasks")->whereIn("status", [1, 2])->orderBy('date_do')->get();
        return view('task.finished-list', [
            "tasks" => $tasks
        ]);
    }

    public function getSearch()
    {
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
    }

    protected function getFirstTask($id)
    {
        return DB::table("tasks")->where("id", "=", $id)->first();
    }
}
