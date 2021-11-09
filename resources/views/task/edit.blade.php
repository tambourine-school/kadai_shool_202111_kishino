<x-task-layout>
    <x-slot name="title">タスク編集</x-slot>
    <div>
        <h2 class="h4">タスクの編集</h2>
    </div>
    <div class="mb-3">
        <form method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ $task[0]->plan }}</label>
                <input type="text" class="form-control" name="name">
                @if(true)
                <div class="error-message">30文字以内で入力してください</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">日付</label>
                <input type="date" class="form-control" name="date_on">
                @if(false)
                <div class="error-message">適切な日付を入力してください</div>
                @endif
            </div>
            <div class="space-evenly mt-5">
                <input type="button" onclick="location.href='/tasks'" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="タスクの修正">
            </div>
            <div class="delete-button">
                <button type="button" onclick="location.href='/tasks'" class="btn btn-danger mt-3">タスクを削除</button>
            </div>
        </form>
    </div>
</x-task-layout>