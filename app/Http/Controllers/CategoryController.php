<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all categories and return them as JSON
        $categories = Category::all();
        return view('category.index', compact('categories'));
       
    }

    public function create()
    {
     
        return view('category.create');
    }



    public function store(Request $request)
    {
     
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new category
        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categories created successfully.');
      
    }


    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));  
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update the category
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Return a JSON response with the updated category
        return redirect()->route('categories.index')->with('success', 'Categories created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Challan deleted successfully.');
    }
}
