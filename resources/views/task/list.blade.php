<x-task-layout>
    <x-slot name="title">タスク一覧</x-slot>
    <div class="text-end my-3">
        <a href="/search" class="btn btn-light">検索画面へ</a>
        <a href="/finished-list" class="btn btn-light">完了タスク一覧へ</a>
        <a href="/tasks/new" class="btn btn-light">タスクの追加</a>
    </div>
    @foreach($tasks as $task)
    <div class="card mb-2">
        <div class="task-list card-body">
            <div>
                <div>{{ $task->plan }}</div>
                <div>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->date_do)->format("Y/m/d") }}</div>
            </div>
            <div>
                <button type="button" onclick="location.href='/tasks/{{ $task->hashed_id }}/edit'" class="btn btn-light">編集</button>
                <button type="button" onclick="location.href='/tasks/{{ $task->hashed_id }}/done'" class="btn btn-dark">完了</button>
            </div>
        </div>
    </div>
    @endforeach
    <div class="page-count my-3">
        @if($id !== '1')
        <a href="/tasks/doing/{{$id-1}}" class="btn btn-light">＜</a>
        @endif
        <p class="mx-3 mt-2">{{$id}}</p>
        @if($isNotLast)
        <a href="/tasks/doing/{{$id+1}}" class="btn btn-light">＞</a>
        @endif
    </div>
</x-task-layout>