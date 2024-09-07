<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferFestival;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::with(['products'])->get();
        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
           
        ]);         

        $offer = Offer::create([
            'title' => $request->input('title'),
            'discount_percentage' => $request->input('discount_percentage'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
        ]);

       

        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        return view('offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update($request->all());
        // Update relationships
        $this->attachRelations($offer, $request);
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Offer::destroy($id);
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }

    private function attachRelations(Offer $offer, Request $request)
    {
        switch ($offer->type) {
            case 'product':
                if ($request->has('product_ids')) {
                    $offer->products()->attach($request->input('product_ids'));
                }
                break;
               case 'festival':
                if ($request->has('festival_ids')) {
                    $offer->festivals()->attach($request->input('festival_ids'));
                }
                break;
           
            default:
              
                break;
        }
    }
}
