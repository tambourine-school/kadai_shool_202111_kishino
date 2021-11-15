<x-task-layout>
    <x-slot name="title">タスク一覧</x-slot>
    <div>
        <form class="mb-3">
            <div>
                <input type="text" class="form-control" name="keyword" placeholder="keyword">
            </div>
            <div class="my-2">
                <label>
                    <input type="checkbox" name="target-period" value="past">過去のもののみ表示
                </label>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-outline-secondary" type="submit">絞り込み</button>
            </div>

        </form>
    </div>
    @if(count($tasks) == 0)
    <div>該当するタスクはありません。</div>
    @else
    @if($keyword == "")
    <div>全件表示</div>
    @else
    <div>{{$keyword}} に該当するものを表示</div>
    @endif
    @foreach($tasks as $task)
    <div class="card mb-2">
        <div class="card-body">
            <div>
                <h5>{{ $task->plan }}</h5>
                <div>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->date_do)->format("Y/m/d") }}</div>
                @if($task->status == 0)
                <div>実行中</div>
                @elseif($task->status == 1)
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
    @endif

</x-task-layout>