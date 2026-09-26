@extends('layouts.app')

@section('content')

    <h2>Add New Task</h2>

    <div class="card">

        <form id="create-task-form" action="/tasks" method="POST">

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

            <button type="submit" class="btn btn-primary">
                Save Task
            </button>

            <a href="/tasks" class="btn">
                Cancel
            </a>

        </form>

    </div>


    <script>

        document.getElementById('create-task-form').addEventListener('submit', async function(event) {

            event.preventDefault();

            const form = this;
            const button = form.querySelector('button[type="submit"]');

            button.disabled = true;
            button.textContent = 'Saving...';

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
                    throw new Error('Failed to save task.');
                }

                // Automatically go back to the task list
                window.location.href = '/tasks';

            } catch (error) {

                alert('Something went wrong while saving the task.');

                button.disabled = false;
                button.textContent = 'Save Task';

            }

        });

    </script>

@endsection