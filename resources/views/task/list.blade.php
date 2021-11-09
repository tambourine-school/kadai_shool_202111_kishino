<x-task-layout>
    <x-slot name="title">タスク一覧</x-slot>
    <div class="text-end my-3">
        <a href="/finished-list" class="btn btn-light">完了タスク一覧へ</a>
        <a href="/tasks/new" class="btn btn-light">タスクの追加</a>
    </div>
    @foreach($tasks as $task)
    <div class="card mb-2">
        <div class="task-list card-body">
            <div>
                <div>{{ $task->plan }}</div>
                <div>{{ $task->date_do }}</div>
            </div>
            <div>
                <button type="button" onclick="location.href='/tasks/{{ $task->id }}/edit'" class="btn btn-light">編集</button>
                <button type="button" onclick="location.href='/tasks/{{ $task->id }}/done'" class="btn btn-dark">完了</button>
            </div>
        </div>
    </div>
    @endforeach
</x-task-layout>