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
        if ($id !== "" . (int)$id) {
            return abort(404);
        }
        $task = $this->getFirstTask($id);
        if (!$task) {
            return abort(404);
        }
        if (!(session()->get("old_form"))) {
            $payload = [
                "plan" => $task->plan,
                "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', $task->date_do)->format("Y-m-d"),
            ];
            session()->flash("old_form", $payload);
        }
        return view('task.edit', [
            "task" => $task
        ]);
    }

    public function getDone($id)
    {
        if ($id !== "" . (int)$id) {
            return abort(404);
        }
        $task = $this->getFirstTask($id);
        if (!$task) {
            return abort(404);
        }
        return view('task.done', [
            "task" => $task
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
