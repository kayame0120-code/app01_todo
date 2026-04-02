<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>TODOリスト</h1>

    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <input type="text" name="content" placeholder="TODOを入力">
        <button type="submit" class="btn-add">追加</button>
    </form>

    @foreach ($tasks as $task)
        <div class="task">
            <span>{{ $task->content }}</span>
            <div>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn-edit">編集</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">削除</button>
                </form>
            </div>
        </div>
    @endforeach

</body>
</html>