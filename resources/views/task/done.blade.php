<x-task-layout>
    <x-slot name="title">タスク完了</x-slot>
    <div class="mb-5">
        <h2 class="h4">タスク名</h2>
    </div>
    <div class="mb-3">
        <form method="post">
            @csrf
            <div class="space-evenly mb-3">
                <div>
                    <input type="radio" aria-label="Radio button for following text input">
                    達成
                </div>
                <div>
                    <input type="radio" aria-label="Radio button for following text input">
                    未達成
                </div>
            </div>
            <p class="down-arrow my-4">↓</p>
            <div class="mb-3">
                <label class="form-label">なぜ？</label>
                <textarea class="form-control" name="check" rows="5"></textarea>
            </div>
            <p class="down-arrow my-4">↓</p>
            <div>
                <label class="form-label">どうする？</label>
                <textarea class="form-control" name="action" rows="5"></textarea>
            </div>
            <div class="space-evenly mt-5">
                <input type="button" onclick="location.href='/tasks'" class="btn btn-light" value="キャンセル">
                <input type="submit" class="btn btn-dark" value="完了">
            </div>
        </form>
    </div>
</x-task-layout>