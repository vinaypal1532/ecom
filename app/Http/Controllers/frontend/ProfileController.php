<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address; 
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        $user = Auth::user();    
        if ($user->role !== 'user') {
            return redirect('/login');
        }

        $addresses = Address::where('user_id', $user->id)->get();
        $orders = Order::where('user_id', $user->id)
        ->with('orderItems') 
        ->orderBy('id','desc')
        ->get();   
        
        return view('profile.index', [
            'user' => $user,
            'addresses' => $addresses,
            'orders' => $orders 
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile_no' => 'required|string|max:15',
            'city' => 'required|string|max:255',
        ]);
    
        // Update user's attributes
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->mobile_no = $validated['mobile_no'];
        $user->city = $validated['city'];   
        
        $user->save();
    
        // Redirect with success message
        return redirect()->route('user-profile.index')->with('success', 'Profile updated successfully.');
    }

    public function download_invoice($id)
    {
       
        $order = Order::with('orderItems')->findOrFail($id);

        // Initialize Dompdf with options
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);

        // Prepare the HTML content for the PDF
        $html = view('profile.invoice', compact('order'))->render();
        $dompdf->loadHtml($html);

        // Set the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Stream the generated PDF back to the browser for download
        return $dompdf->stream('invoice_' . $id . '.pdf');
    }
    
  
}
