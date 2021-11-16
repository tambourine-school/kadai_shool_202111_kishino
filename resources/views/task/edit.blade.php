<x-task-layout>
    <x-slot name="title">タスク編集</x-slot>
    <div>
        <h2 class="h4">タスクの編集</h2>
    </div>
    <div class="mb-3">
        <form method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">タスク名</label>
                <input type="text" class="form-control" name="plan" value="{{$task->plan}}">
                @if(session()->get("errors.plan") === ['The plan field is required.'])
                <div class="error-message">タスクを入力してください</div>
                @elseif(session()->get("errors.plan") === ['The plan must not be greater than 20 characters.'])
                <div class="error-message">20文字以内で入力してください</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">日付</label>
                <input type="date" class="form-control" name="date_do" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->date_do)->format("Y-m-d")}}">
                @if(session()->get("errors.date_do") === ['The date do field is required.'])
                <div class="error-message">適切な日付を入力してください</div>
                @elseif(session()->get("errors.date_do") === ['The date do must be a date after yesterday.'])
                <div class="error-message">本日以降を入力してください</div>
                @endif
            </div>
            <div class="space-evenly mt-5">
                <input type="button" onclick="location.href='/tasks'" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="タスクの修正">
            </div>
        </form>
        <form method="post" action="/tasks/{{$task->id}}/delete">
            @csrf
            <div class="delete-button">
                <button type="submit" class="btn btn-danger mt-3">タスクを削除</button>
            </div>
        </form>
    </div>
</x-task-layout>