@extends('layouts.app')

@section('content')
    <h2>Add New Task</h2>
    <div class="card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Task Name</label>
                <input type="text" name="task_name" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Due Date</label>
                <input type="date" name="due_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Task</button>
            <a href="{{ route('tasks.index') }}" class="btn">Cancel</a>
        </form>
    </div>
@endsection