@extends('layouts.app')

@section('content')
    
    <a href="/tasks/create" class="btn btn-primary">+ Add New Task</a>

    <h2 style="margin: 1.5rem 0;">Your Tasks</h2>

    <div id="task-list">

        @if($tasks->isEmpty())
            <p id="no-tasks">No tasks yet. Create your first task!</p>
        @else
            @foreach($tasks as $task)

                <div class="card" id="task-{{ $task->id }}">

                    <h3>{{ $task->task_name }}</h3>

                    <p>{{ $task->description }}</p>

                    <p>
                        <strong>Due:</strong>
                        {{ $task->due_date }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        <span class="task-status {{ $task->status === 'Completed' ? 'status-completed' : 'status-pending' }}">
                            {{ $task->status }}
                        </span>
                    </p>

                    <div>

                        <!-- MARK COMPLETE / PENDING -->
                        <form
                            action="/tasks/{{ $task->id }}/toggle"
                            method="POST"
                            class="toggle-form"
                            style="display: inline;"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-success">
                                {{ $task->status === 'Pending' ? 'Mark Complete' : 'Mark Pending' }}
                            </button>
                        </form>

                        <!-- EDIT -->
                        <a
                            href="/tasks/{{ $task->id }}/edit"
                            class="btn btn-warning"
                        >
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form
                            action="/tasks/{{ $task->id }}"
                            method="POST"
                            class="delete-form"
                            style="display: inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach
        @endif

    </div>



    <!-- JAVASCRIPT -->
    <script>

        // MARK COMPLETE OR PENDING

        document.querySelectorAll('.toggle-form').forEach(form => {

            form.addEventListener('submit', async function(event) {

                event.preventDefault();

                const button = form.querySelector('button');
                const card = form.closest('.card');
                const status = card.querySelector('.task-status');

                button.disabled = true;

                try {

                    const response = await fetch(form.action, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Failed to update status.');
                    }

                    const data = await response.json();

                    status.textContent = data.status;

                    if (data.status === 'Completed') {
                        status.classList.remove('status-pending');
                        status.classList.add('status-completed');
                        button.textContent = 'Mark Pending';
                    } else {
                        status.classList.remove('status-completed');
                        status.classList.add('status-pending');
                        button.textContent = 'Mark Complete';
                    }

                } catch (error) {

                    alert('Something went wrong while updating the status.');

                } finally {

                    button.disabled = false;

                }

            });

        });


        //IDELETE ANG TASK

        document.querySelectorAll('.delete-form').forEach(form => {

            form.addEventListener('submit', async function(event) {

                event.preventDefault();

                if (!confirm('Delete this task?')) {
                    return;
                }

                const card = form.closest('.card');

                try {

                    const response = await fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Failed to delete task.');
                    }

                    card.remove();

                    // If there are no more tasks
                    if (document.querySelectorAll('.card').length === 0) {

                        document.getElementById('task-list').innerHTML =
                            '<p id="no-tasks">No tasks yet. Create your first task!</p>';

                    }

                } catch (error) {

                    alert('Something went wrong while deleting the task.');

                }

            });

        });

    </script>

@endsection