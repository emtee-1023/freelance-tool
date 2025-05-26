<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::query()->where('id', '!=', 1)->get();
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $client = Client::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Client registered successfully',
                'client' => $client,
            ]);
        }

        return redirect()->route('client.index')->with('success', 'Client Registered Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $client->update([
            'name' => $request->name,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client details updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfuly');
    }
}
