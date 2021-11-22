<x-task-layout>
    <x-slot name="title">タスク編集</x-slot>
    <div>
        <h2 class="h4">タスクの編集</h2>
    </div>
    <div class="mb-3">
        <form method="post" action="/tasks/{{$task->hashed_id}}/edit">
            @csrf
            <div class="mb-3">
                <label class="form-label">タスク名</label>
                <input type="text" class="form-control" name="plan" value="{{session()->get("old_form.plan")}}">

                @if(in_array("The plan field is required.", session()->get("errors.plan", [])))
                <div class="error-message">タスクを入力してください</div>
                @endif
                @if(in_array("The plan must not be greater than 20 characters.", session()->get("errors.plan", [])))
                <div class="error-message">20文字以内で入力してください</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">日付</label>
                <input type="date" class="form-control" name="date_do" value="{{session()->get("old_form.date_do")}}">
                @if(in_array("The date do field is required.", session()->get("errors.date_do", [])))
                <div class="error-message">適切な日付を入力してください</div>
                @endif
                @if(in_array("The date do must be a date after yesterday.", session()->get("errors.date_do", [])))
                <div class="error-message">本日以降を入力してください</div>
                @endif
            </div>
            <div class="space-evenly mt-5">
                <input type="button" onclick="history.back()" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="タスクの修正">
            </div>
        </form>
        <form method="post" action="/tasks/{{$task->hashed_id}}/delete">
            @csrf
            <div class="delete-button">
                <button type="submit" class="btn btn-danger mt-3">タスクを削除</button>
            </div>
        </form>
    </div>
</x-task-layout>