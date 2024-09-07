<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',           
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = new Review([
            'product_id' => $request->input('product_id'), 
            'user_id' =>1, 
            'name' => $request->input('name'), 
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        $review->save();

        return response()->json(['success' => 'Review submitted successfully!']);
    }

    public function show($productId)
    {
        $product = Product::with('reviews.user')->findOrFail($productId);
        return view('products.show', compact('product'));
    }
}
