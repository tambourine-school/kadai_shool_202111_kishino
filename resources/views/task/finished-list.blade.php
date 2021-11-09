<x-task-layout>
    <x-slot name="title">完了タスク一覧</x-slot>
    <div>
        <h2 class="h4">完了タスク</h2>
    </div>
    @foreach($tasks as $task)
    <div class="card mb-2">
        <div class="card-body">
            <div>
                <h5>{{ $task->plan }}</h5>
                <div>{{ $task->date_do }}</div>
                <div>{{ $task->status }}</div>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td>なぜ？</td>
                        <td>{{ $task->check }}</td>
                    </tr>
                    <tr>
                        <td>どうする？</td>
                        <td>{{ $task->action }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
    <input type="submit" onclick="location.href='/tasks'" class="btn btn-dark mt-3" value="タスク一覧へ戻る">
</x-task-layout>