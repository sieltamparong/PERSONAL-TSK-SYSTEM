<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
     // 1. Show ALL tasks
    public function index(): View
    {
        $tasks = Task::latest()->get(); // Get all tasks, newest first
        return view('tasks.index', compact('tasks'));
    }

    // 2. Show CREATE form
    public function create(): View
    {
        return view('tasks.create');
    }

    // 3. SAVE new task to DB
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'task_name'   => 'required|max:255',
            'description' => 'nullable',
            'due_date'    => 'required|date',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'success'=> true,
            'message'=> 'Task added!',
            'task'=> $task
        ]);
    }

    // 4. Show EDIT form
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    // 5. UPDATE existing task
    public function update(Request $request, Task $task) 
    {
        $validated = $request->validate([
            'task_name'   => 'required|max:255',
            'description' => 'nullable',
            'due_date'    => 'required|date',
            'status'      => 'required|in:Pending,Completed',
        ]);

        $task->update($validated);

        return response()->json([
            'success'=> true,
            'message'=> 'Task Updated!',
            'task'=> $task
        ]);
    }

    // 6. DELETE task
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task Deleted!'
        ]);
    }

    // 7. TOGGLE status (Pending ↔ Completed)
    public function toggleStatus(Task $task)
    {
    $task->update([
        'status' => $task->status === 'Pending'
            ? 'Completed'
            : 'Pending'
    ]);

    return response()->json([
        'success' => true,
        'status' => $task->status
    ]);
    }
}
