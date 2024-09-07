<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {    
        $orders = Order::with('user')
        ->orderBy('id','Desc')        
        ->get();       
        return view('orders.index', compact('orders'));
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Fetch the specific order with its related OrderItems
        $order = Order::with('OrderItems')->findOrFail($order->id);
    
        // Pass the order data to the view
        return view('orders.show', compact('order'));
    }

    public function show_invoice($order_id)
        {
            $order = Order::with('OrderItems.product')->where('order_id', $order_id)->firstOrFail();
            return view('orders.invoice', compact('order'));
        }

    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
