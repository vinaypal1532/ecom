<?php
namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::all();
        return view('subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required',
            'category_id' => 'required|exists:categories,id', // Corrected table name
        ]);

        // Create a new subcategory
        SubCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);

        // Redirect with success message
        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        return view('subcategory.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('subcategory.edit', compact('subCategory', 'categories')); // Pass both subcategory and categories
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', 
        ]);

        // Update the subcategory
        $subCategory->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);

        // Redirect with success message
        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            // Delete the subcategory
            $subCategory->delete();

            // Redirect with success message
            return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors that occur during the deletion
            return redirect()->route('subcategories.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
