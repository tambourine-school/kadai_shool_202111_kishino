<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Service\TaskService;
use Illuminate\Support\Str;

class TaskController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTopPage()
    {
        return redirect('/tasks/doing/1');
    }

    public function getTasksPage($page)
    {
        if ($page !== "" . (int)$page) {
            return abort(404);
        }
        $isNotLast = $this->taskService->getRunningTasksNumber() >= $page * 10;
        if (!$isNotLast) {
            return abort(404);
        }
        $tasks = $this->taskService->getRunningTasksPerTen($page);
        return view('task.list', [
            "tasks" => $tasks,
            "id" => $page,
            "isNotLast" => $isNotLast,
        ]);
    }

    public function getNewTaskPage()
    {
        return view('task.new');
    }

    public function getEditTaskPage($hashedId)
    {
        $task = $this->taskService->getFirstTaskByHashedId($hashedId);
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

    public function getDoneTaskPage($hashedId)
    {
        $task = $this->taskService->getFirstTaskByHashedId($hashedId);
        if (!$task) {
            return abort(404);
        }
        return view('task.done', [
            "task" => $task
        ]);
    }

    public function getFinishedTaskPage()
    {
        $tasks = $this->taskService->getFinishedTasks();
        return view('task.finished-list', [
            "tasks" => $tasks
        ]);
    }

    public function getSearchPage()
    {
        $keyword = request()->get("keyword");
        $targetPeriod = request()->get("target-period");
        if ($targetPeriod == 'past') {
            $tasks = $this->taskService->getTasksByKeywordFromNow($keyword);
        } elseif ($targetPeriod == '') {
            $tasks = $this->taskService->getTasksByKeyword($keyword);
        }
        return view('task.search', [
            "tasks" => $tasks, "keyword" => $keyword
        ]);
    }

    public function postNewTask()
    {
        $payload = [
            "hashed_id" => Str::random(20),
            "plan" => request()->get("plan"),
            "date_do" => request()->get("date_do"),
            "status" => 0,
            "created_at" => Carbon::now(),
        ];
        $rules = [
            "plan" => ["required", "max:20"],
            "date_do" => ["required", "after:yesterday"],
        ];
        $val = validator($payload, $rules);
        if ($val->fails()) {
            session()->flash("old_form", $payload);
            session()->flash("errors", $val->errors()->toArray());
            return redirect("/tasks/new");
        }
        $this->taskService->insertTask($payload);
        return redirect("/tasks/doing/1");
    }

    public function postEditTask($hashedId)
    {
        $payload = [
            "plan" => request()->get("plan"),
            "date_do" => request()->get("date_do"),
        ];
        $rules = [
            "plan" => ["required", "max:20"],
            "date_do" => ["required", "after:yesterday"],
        ];
        $val = validator($payload, $rules);
        if ($val->fails()) {
            session()->flash("old_form", $payload);
            session()->flash("errors", $val->errors()->toArray());
            return redirect("/tasks/$hashedId/edit");
        }
        $this->taskService->updateTask($hashedId, $payload);
        return redirect("/tasks/doing/1");
    }

    public function postDeleteTask($hashedId)
    {
        $this->taskService->deleteTask($hashedId);
        return redirect("/tasks/doing/1");
    }

    public function postDoneTask($hashedId)
    {
        $payload = [
            "status" => request()->get("status"),
            "check" => request()->get("check"),
            "action" => request()->get("action"),
        ];
        $rules = [
            "status" => ["required"],
            "check" => ["required", "max:400"],
            "action" => ["required", "max:400"],
        ];
        $val = validator($payload, $rules);
        if ($val->fails()) {
            session()->flash("old_form", $payload);
            session()->flash("errors", $val->errors()->toArray());
            return redirect("/tasks/$hashedId/done");
        }
        $this->taskService->updateTask($hashedId, $payload);
        return redirect("/tasks/doing/1");
    }
}
