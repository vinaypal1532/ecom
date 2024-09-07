<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::where('role' , 'user')
                   ->orderBy('id','Desc')
                 ->get();
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'b_name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clients,email',
            'city' => 'required|string|max:50',
            'status' => 'required|in:1,0', 
            'mobile_no' => 'required|string|max:15',
        ]);
        Client::create([
            'name' => $request->name,
            'b_name' => $request->b_name,
            'email' => $request->email,
            'city' => $request->city,
            'status' => $request->status,
            'mobile_no' => $request->mobile_no,
        ]);

    return redirect()->route('client.index')->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = User::find($id);
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    public function edit(User $client)
    {
       
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $client)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:100',          
            'email' => 'required|email|max:100|unique:clients,email,' . $client->id,
            'city' => 'required|string|max:50',
            'status' => 'required', 
            'mobile_no' => 'required|string|max:15',
        ]);
    
      
        $client->update([
            'name' => $request->input('name'),         
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'status' => $request->input('status'),
            'mobile_no' => $request->input('mobile_no'),
        ]);
    
        // Redirect with a success message
        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
