<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>TODO編集</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="content" value="{{ $task->content }}">
        <button type="submit" class="btn-update">更新</button>
    </form>
    <p><a href="{{ route('tasks.index') }}" class="btn back">戻る</a></p>
</body>
</html>