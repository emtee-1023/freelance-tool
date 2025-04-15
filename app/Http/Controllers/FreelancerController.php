<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\FreelancerWelcomeNotification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$freelancers = User::where('user_type', 'freelancer')->get();
        $freelancers = User::withCount(['tasks as tasks_in_progress_count' => function ($query) {
            $query->where('status', 'in progress');
        }])->get();
        return view('freelancers.index', compact('freelancers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('freelancers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // 'Name' → should be lowercase to match the input field
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:9',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        // Create the freelancer
        $freelancer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'freelancer',
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'city' => $request->city,
            'password' => bcrypt('Freetool@2025') // Temporary fallback password
        ]);

        // Generate password reset token
        $token = Password::createToken($freelancer);

        // Send email with token to set password
        $freelancer->notify(new FreelancerWelcomeNotification($token));

        return redirect()->route('freelancers.index')
            ->with('success', 'Freelancer added successfully! They’ve been emailed a link to set their password.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $freelancer = User::findOrFail($id);
        return view('freelancers.edit', compact('freelancer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $freelancer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $freelancer->id,
            'phone_number' => 'required|string|max:10',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $freelancer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'city' => $request->city,
        ]);

        return redirect()->route('freelancers.index')
            ->with('success', 'Freelancer\'s details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $freelancer)
    {
        $freelancer->delete();
        return redirect()->route('freelancers.index')->with('success', 'Freelancer deleted successfully.');
    }
}
