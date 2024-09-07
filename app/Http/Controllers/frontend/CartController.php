<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Address; 
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderCancellationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // public function __construct()
    // {
      
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            // Option 1: Redirect to a different page or route
            return redirect()->route('empty-cart');
            
            // Option 2: Return a view indicating the cart is empty
            // return view('frontend.empty-cart'); // Make sure to create this view
        }
    
        return view('frontend.cart', compact('cart'));
    }
    

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $product->quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }
    

    public function cartCount()
    {
        $count = count(Session::get('cart', []));
        return response()->json(['count' => $count]);
    }

    public function update(Request $request)
{
    $cart = session()->get('cart', []);
    
    $id = $request->input('id');
    $quantity = $request->input('quantity');

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $quantity;
    }

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'cart' => $cart
    ]);
}

public function remove(Request $request)
{
    $cart = session()->get('cart', []);
    
    $id = $request->input('id');

    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'cart' => $cart
    ]);
}
public function checkout()
{
    $user = Auth::user();
    
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Please log in to proceed to checkout.');
    }
    
    $addresses = Address::where('user_id', $user->id)->get();
    
    $cart = Session::get('cart', []);
    
    if (empty($cart)) {
        return redirect()->route('empty-cart')->with('error', 'Your cart is empty!');
    }
    
    $subtotal = array_reduce($cart, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    $shipping = $subtotal > 500 ? 0 : 49;
    $total = $subtotal + $shipping;
    
    return view('frontend.checkout', [
        'addresses' => $addresses,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,
    ]);
}

public function process(Request $request)
{
   
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Please log in to proceed to checkout.');
    }

    // Retrieve the authenticated user
    $user = Auth::user();

    // Check if user has an existing address
    $address = $user->addresses()->first();

    // If no address exists, validate and create a new one
    if (!$address) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|string|in:cod',
        ]);

        $address = new Address();
        $address->user_id = $user->id;
        $address->name = $validated['name'];
        $address->mobile = $validated['mobile'];
        $address->pincode = $validated['pincode'];
        $address->locality = $request->input('locality');
        $address->city = $validated['city'];
        $address->state = $request->input('state');
        $address->address = $validated['address'];
        $address->landmark = $request->input('landmark');
        $address->alternate_phone = $request->input('alternate_phone');
        $address->priority = 'primary';
        $address->save();
    }

    // Retrieve the cart from the session
    $cart = Session::get('cart', []);

    // Check if the cart is empty
    if (empty($cart)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }

    // Calculate totals
    $subtotal = array_reduce($cart, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
     $shipping = $subtotal > 500 ? 0 : 49;
    $total = $subtotal + $shipping;

    // Generate a unique order_id
    do {
        $orders_id = mt_rand(100000, 999999);
    } while (Order::where('order_id', $orders_id)->exists());

    // Create the order
    $order = Order::create([
        'user_id' => $user->id,
        'order_id' => $orders_id,
        'total' => $total,
        'shipping' => $shipping,
        'address_id' => $request->input('selected_address'),
        'status' => 'pending',
    ]);

    // Add items to the order_items table
    foreach ($cart as $id => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $id,
            'price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);
    }

      // Create payment record
      $payment = new Payment();
      $payment->order_id = $order->id;
      $payment->amount = $total;
      $payment->method = $request->input('payment_method');
      $payment->status = 'pending'; 
      $payment->save();

      Mail::to($user->email)->send(new OrderConfirmationMail($order, $user));

      Session::forget('cart');
    
    return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully!');

   
}
public function order_cancel($id)
{
    // Validate the order ID
    //$orderId = $request->input('id');
    $order = Order::where('id', $id)->where('user_id', Auth::id())->first();

    if (!$order) {
        return redirect()->route('user-profile.index')->with('error', 'Order not found or unauthorized access.');
    }

    // Check if the order can be canceled (e.g., only if it's pending)
    if ($order->status !== 'pending') {
        return redirect()->route('user-profile.index')->with('error', 'Order cannot be canceled.');
    }

    // Update the order status to canceled
    $order->status = 'canceled';
    $order->save();

    // Restore the inventory (if applicable)
    foreach ($order->orderItems as $item) {
        $product = Product::find($item->product_id);
        if ($product) {
            $product->stock += $item->stock;
            $product->save();
        }
    }

   
    $payment = Payment::where('order_id', $order->id)->first();
    if ($payment) {
        $payment->status = 'canceled';
        $payment->save();
    }
  
    Mail::to(Auth::user()->email)->send(new OrderCancellationMail($order, Auth::user()));
   

    return redirect()->route('user-profile.index')->with('success', 'Your order has been canceled successfully.');
}


    
}
