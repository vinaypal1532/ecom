<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('subCategory')
                    ->orderBy('id','Desc')
                    ->get(); 
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories  = SubCategory::all(); 
        return view('product.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'required|file|mimes:jpg,jpeg,png,webp',
            'type' => 'nullable|string',
            'status' => 'nullable',
        ]);

        $imageName = $request->file('image')->hashName(); 
       
        $request->file('image')->move(public_path('images/product'), $imageName);      

        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount_price' => $request->input('discount_price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'image' => $imageName,
            'subcategory_id' => $request->input('subcategory_id'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
        ]);

        // Redirect with success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $subcategories  = SubCategory::all(); // Fetch all subcategories for the dropdown
        return view('product.edit', compact('product', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product->id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
            'type' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1,2', 
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('images/product/' . $product->image))) {
                unlink(public_path('images/product/' . $product->image));
            }
    
            // Upload the new image
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/product/'), $imageName);
    
            // Update the image path in the validated data
            $validatedData['image'] = $imageName;
        }
    
        $product->update($validatedData);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Delete the product
            $product->delete();

            // Redirect with success message
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors that occur during the deletion
            return redirect()->route('products.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
