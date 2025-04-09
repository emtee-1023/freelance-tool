<?php

namespace App\Http\Controllers;

use App\Models\FiverrAccount;
use Illuminate\Http\Request;

class FiverrAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = FiverrAccount::withCount(['tasks as tasks_in_progress_count' => function ($query) {
            $query->where('status', 'in progress');
        }])->get();
        return view("fiverr.index", compact("accounts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("fiverr.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:fiverr_accounts,username',
            'link' => 'nullable|string'
        ]);

        $account = FiverrAccount::create([
            'username' => $request->username,
            'link' => $request->link,
        ]);

        return redirect()->route('fiverr-accounts.index')->with('success', 'Fiverr Account Added Successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(FiverrAccount $fiverrAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FiverrAccount $fiverrAccount)
    {
        $account = FiverrAccount::findOrFail($fiverrAccount->id);
        return view('fiverr.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FiverrAccount $fiverrAccount)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:fiverr_accounts,username,' . $fiverrAccount->id,
            'link' => 'nullable|string',
        ]);

        $account = FiverrAccount::create([
            'username' => $request->username,
            'link' => $request->link,
        ]);

        return redirect()->route('fiverr-accounts.index')->with('success', 'Fiverr Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FiverrAccount $fiverrAccount)
    {
        $fiverrAccount->delete();
        return redirect()->route('fiverr-accounts.index')->with('success', 'Fiverr Account Deleted Successfully');
    }
}
