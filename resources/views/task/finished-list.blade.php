<x-task-layout>
    <x-slot name="title">完了タスク一覧</x-slot>
    <div>
        <h2 class="h4">完了タスク</h2>
    </div>
    @for ($i = 0; $i < 5; $i++) <div class="card mb-2">
        <div class="card-body">
            <div>
                <h5>タスク{{ $i }}</h5>
                <div>2021/11/1</div>
                <div>達成</div>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td>なぜ？</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, quis facere officia, atque neque cumque nisi placeat commodi amet ipsum unde sequi similique sapiente natus nulla beatae iste. Beatae, eos.</td>
                    </tr>
                    <tr>
                        <td>どうする？</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam quis voluptas maiores magnam ab? Illum magni iure, tenetur quisquam eos distinctio fuga! Laborum similique iusto delectus quia sit, nostrum quod.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        @endfor
        <input type="submit" onclick="location.href='/tasks'" class="btn btn-dark mt-3" value="タスク一覧へ戻る">
</x-task-layout>