<?php

namespace App\Http\Controllers;

use App\Models\FiverrAccount;
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
        $fiverrAccounts = FiverrAccount::all();
        return view('tasks.create', compact('freelancers', 'statuses', 'fiverrAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'fiverr_account' => 'nullable|exists:fiverr_accounts,id',
            'amount' => 'required|numeric|min:0',
            'freelancer_pay' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to ?: null,
            'fiverr_account_id' => $request->fiverr_account ?: null,
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
        $fiverrAccounts = FiverrAccount::all();
        return view('tasks.edit', compact('task', 'freelancers', 'statuses', 'fiverrAccounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'fiverr_account' => 'nullable|exists:fiverr_accounts,id',
            'amount' => 'required|numeric|min:0',
            'freelancer_pay' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:' . implode(',', Task::getStatusOptions()),
        ]);

        if ($request->assigned_to !== null) {
            $status = $request->status ?: 'in progress';
        } else {
            $status = 'pending assignment';
        };

        // Update the task
        $task->update([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to ?: null,
            'fiverr_account_id' => $request->fiverr_account ?: null,
            'amount' => $request->amount,
            'freelancer_pay' => $request->freelancer_pay,
            'deadline' => $request->deadline,
            'status' => $status,
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
