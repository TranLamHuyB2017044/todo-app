<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
</head>
<body>
    <h1>Todo List</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nhập công việc">
        <button type="submit">Thêm</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <li>
                <form action="{{ route('tasks.update', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">{{ $task->completed ? '✅' : '⭕' }}</button>
                </form>
                {{ $task->title }}
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">X</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
