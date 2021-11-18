<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Service\TaskService;

class TaskController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTopPage()
    {
        return redirect('/tasks');
    }

    public function getTasksPage()
    {
        $tasks = $this->taskService->getRunningTasks();
        return view('task.list', [
            "tasks" => $tasks
        ]);
    }

    public function getNewTaskPage()
    {
        return view('task.new');
    }

    public function getEditTaskPage($id)
    {
        if ($id !== "" . (int)$id) {
            return abort(404);
        }
        $task = $this->taskService->getFirstTask($id);
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

    public function getDoneTaskPage($id)
    {
        if ($id !== "" . (int)$id) {
            return abort(404);
        }
        $task = $this->taskService->getFirstTask($id);
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
        return redirect("/tasks");
    }

    public function postEditTask($id)
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
            return redirect("/tasks/$id/edit");
        }
        $this->taskService->updateTask($id, $payload);
        return redirect("/tasks");
    }

    public function postDeleteTask($id)
    {
        $this->taskService->deleteTask($id);
        return redirect("/tasks");
    }

    public function postDoneTask($id)
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
            return redirect("/tasks/$id/done");
        }
        $this->taskService->updateTask($id, $payload);
        return redirect("/tasks");
    }
}
