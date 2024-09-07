<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
               
            $team = User::where('role','user')
             ->orderBy('id', 'desc')
             ->get(); 
            
            return view('team.index', ['team' => $team]);
          
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('team.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'required|string',            
            'image' => 'required|file|mimes:jpg,jpeg,png,webp',
            'city' => 'nullable|string',          
            'status' => 'required|in:1,0,2',
            'email' => 'required|email|unique:users,email', 
            'password' => 'required',           
            'mobile_no' => 'required|unique:users,mobile_no',
            'basic_salary' => 'required|numeric',
        ]);

        $imageName = $request->file('image')->hashName(); 
       
        $request->file('image')->move(public_path('images'), $imageName);      
      
          $service =  User::create([
            'name' => $validatedData['name'],                 
            'image' => $imageName,
            'city' => $validatedData['city'],
            'status' => $validatedData['status'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'mobile_no' => $validatedData['mobile_no'],
            'basic_salary' => $validatedData['basic_salary'],
        ]);
                     
        
        return redirect()->route('emp-list')->with('success', 'Employee Details Created Successfully');
    }

    /**
     * Display the specified resource.
     */
   

     public function show(User $user)
     {       
         return view('team.show', compact('user'));
     }
     

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
        $teacher = User::findOrFail($id); 
    
        return view('team.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string',              
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            'city' => 'nullable|string',
            'status' => 'required|in:1,0,2',
            'email' => 'required|email', 
            'password' => 'required',   
            'mobile_no' => 'required',
            'basic_salary' => 'required|numeric',
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($course->image && file_exists(public_path('images/' . $course->image))) {
                unlink(public_path('images/' . $course->image));
            }
    
            // Upload the new image
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $imageName);
    
            // Update the image path in the validated data
            $validatedData['image'] = $imageName;
        }
   
        $course->update($validatedData);
    
        return redirect()->route('emp-list')->with('success', 'Employee Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('emp-list')->with('error', 'Employee not found.');
        }
    
        if ($user->file_path && File::exists(public_path('images/' . $user->file_path))) {
            File::delete(public_path('images/' . $user->file_path));
        }
    
        $user->delete(); // Soft delete
    
        return redirect()->route('emp-list')->with('success', 'Employee deleted successfully.');
    }
    
}
