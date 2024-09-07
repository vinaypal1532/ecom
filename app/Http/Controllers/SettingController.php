<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

   public function index()
    {
        $setting = Setting::first(); // Assuming there's only one setting record
        return view('setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first(); // Get the first (and only) setting record
    
        $request->validate([
            'pan_card'=>'required',
            'email' => 'required|email',
            'title' => 'required|string',
            'mobile_no' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($setting->logo) {
                \File::delete(public_path('images/' . $setting->logo));
            }
    
            // Generate a new file name and move the uploaded file
            $imageName = $request->file('logo')->hashName();
            $request->file('logo')->move(public_path('images'), $imageName);
        } else {
            $imageName = $setting->logo; // Keep the old logo if no new file is uploaded
        }
    
        $setting->update([
            'title' => $request->title,
            'pan_card' => $request->pan_card,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'logo' => $imageName,
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
