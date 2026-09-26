@extends('layouts.app')

@section('content')

    <h2>Edit Task</h2>

    <div class="card">

        <form id="update-task-form" action="/tasks/{{ $task->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Task Name</label>
                <input
                    type="text"
                    name="task_name"
                    value="{{ $task->task_name }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea
                    name="description"
                    rows="3"
                >{{ $task->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Due Date</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Status</label>

                <select name="status">

                    <option value="Pending"
                        {{ $task->status === 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Completed"
                        {{ $task->status === 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Update Task
            </button>

            <a href="/tasks" class="btn">
                Cancel
            </a>

        </form>

    </div>


    <script>

        document.getElementById('update-task-form').addEventListener('submit', async function(event) {

            event.preventDefault();

            const form = this;
            const button = form.querySelector('button[type="submit"]');

            button.disabled = true;
            button.textContent = 'Updating...';

            const formData = new FormData(form);

            try {

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Failed to update task.');
                }

                window.location.href = '/tasks';

            } catch (error) {

                alert('Something went wrong while updating the task.');

                button.disabled = false;
                button.textContent = 'Update Task';

            }

        });

    </script>

@endsection