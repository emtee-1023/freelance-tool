<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $freelancers = User::where('user_type', 'freelancer')->get();
        $statuses = Task::getStatusOptions();
        return view('tasks.create', compact('freelancers', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'freelancer_pay' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to ?: null,
            'amount' => $request->amount,
            'freelancer_pay' => $request->freelancer_pay,
            'deadline' => $request->deadline,
            'status' => $request->assigned_to ? 'in progress' : 'pending assignment',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $freelancers = User::where('user_type', 'freelancer')->get();
        $statuses = Task::getStatusOptions();
        return view('tasks.edit', compact('task', 'freelancers', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'freelancer_pay' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:' . implode(',', Task::getStatusOptions()),
        ]);

        // Determine the status
        $status = $request->status; // First check if a manual status is provided
        if (is_null($status)) {
            // If no status is manually set, determine the status based on 'assigned_to'
            $status = $request->assigned_to ? 'in progress' : 'pending assignment';
        }

        // Update the task
        $task->update([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to ?: null, // Ensures null if no freelancer is selected
            'amount' => $request->amount,
            'freelancer_pay' => $request->freelancer_pay,
            'deadline' => $request->deadline,
            'status' => $status, // Set status based on the logic above
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
