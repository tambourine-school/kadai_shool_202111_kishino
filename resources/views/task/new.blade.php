<x-task-layout>
    <x-slot name="title">タスク作成</x-slot>
    <div>
        <h2 class="h4">タスクの追加</h2>
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
                <input type="button" onclick="location.href='/tasks'" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="タスクの追加">
            </div>
        </form>
    </div>
</x-task-layout>