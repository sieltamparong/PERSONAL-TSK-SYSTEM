@extends('layouts.app')

@section('content')
    <h2>Edit Task</h2>
    <div class="card">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Task Name</label>
                <input type="text" name="task_name" value="{{ $task->task_name }}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" required>{{ $task->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ $task->due_date }}" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn">Cancel</a>
        </form>
    </div>
@endsection