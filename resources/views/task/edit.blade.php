<x-task-layout>
    <div>
        <h2 class="h4">タスクの編集</h2>
    </div>
    <div class="mb-3">
        <form method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">タスク名</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">日付</label>
                <input type="date" class="form-control" name="date_on">
            </div>
            <div class="space-evenly mt-5">
                <input type="submit" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="タスクの修正">
            </div>
            <div class="delete-button">
                <button type="button" class="btn btn-danger mt-3">タスクを削除</button>
            </div>
        </form>
    </div>
</x-task-layout>