<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Mail\AddressCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Address; 
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store a newly created address in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'pincode' => 'required|string|max:10',
            'locality' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string',
            'landmark' => 'nullable|string|max:255',
            'alternate_phone' => 'nullable|digits:10',
            'priority' => 'nullable', 
        ]);

        $address = Address::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'user_id' => Auth::id(), 
            'pincode' => $request->input('pincode'),
            'locality' => $request->input('locality'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'state' => $request->input('state'),
            'landmark' => $request->input('landmark'),
            'alternate_phone' => $request->input('alternate_phone'),
            'priority' => $request->input('priority', 'primary'), 
        ]);

        Mail::to(Auth::user()->email)->send(new AddressCreated($address));

        return redirect()->route('user-profile.index')->with('success', 'Address created successfully.'); 
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:addresses,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
            'locality' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'landmark' => 'nullable|string',
            'alternate_phone' => 'nullable|string',
        ]);

        $address = Address::findOrFail($validated['id']);
        $address->update($validated);

        return redirect()->route('user-profile.index')->with('success', 'Address updated successfully!');
    }
    
    public function destroy($id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    
}
