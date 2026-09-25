@extends('layouts.app')

@section('content')
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add New Task</a>

    <h2 style="margin: 1.5rem 0;">Your Tasks</h2>

    @if($tasks->isEmpty())
        <p>No tasks yet. Create your first task!</p>
    @else
        @foreach($tasks as $task)
            <div class="card">
                <h3>{{ $task->task_name }}</h3>
                <p>{{ $task->description }}</p>
                <p><strong>Due:</strong> {{ $task->due_date }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="{{ $task->status === 'Completed' ? 'status-completed' : 'status-pending' }}">
                        {{ $task->status }}
                    </span>
                </p>
                <div>
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST" style="display: inline;">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-success">
                            {{ $task->status === 'Pending' ? 'Mark Complete' : 'Mark Pending' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this task?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection