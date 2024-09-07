<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'rating' => 'required|numeric|min:1|max:5',
        'city' => 'required|string',
        'message' => 'required|string',
        'status' => 'required|string|in:1,0',
    ]);

    // Create a new Testimonial record
    $testimonial = Testimonial::create([
        'name' => $validatedData['name'],
        'rating' => $validatedData['rating'],
        'city' => $validatedData['city'],
        'image' => 'gjghjg',  // Replace this with the actual image upload logic if needed
        'message' => $validatedData['message'],
        'status' => $validatedData['status'],
    ]);

    // Redirect back to the testimonial index page with a success message
    return redirect()->route('testimonial')
                     ->with('success', 'Testimonial created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'content' => 'required|string',
            'author' => 'required|string',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('testimonials.index')
                         ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
    
        return redirect()->route('testimonial')
                         ->with('success', 'Testimonial deleted successfully.');
    }
    
}
