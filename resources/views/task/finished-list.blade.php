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
                <div>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->date_do)->format("Y/m/d") }}</div>
                @if($task->status == 1)
                <div class="text-success">達成</div>
                @elseif($task->status == 2)
                <div class="text-danger">未達成</div>
                @endif
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
    <input type="submit" onclick="history.back()" class="btn btn-dark mt-3" value="タスク一覧へ戻る">
</x-task-layout>