<x-task-layout>
    <div class="text-end my-3">
        <a href="/tasks/new" class="btn btn-light">タスクの追加</a>
    </div>
    @for ($i = 0; $i < 5; $i++) <div class="card mb-2">
        <div class="task-list card-body">
            <div>
                <div>タスク{{ $i }}</div>
                <div>2021/11/1</div>
            </div>
            <button type="button" onclick="location.href='/tasks/{{ $i }}/edit'" class="btn btn-light">編集</button>
        </div>
        </div>
        @endfor
</x-task-layout>