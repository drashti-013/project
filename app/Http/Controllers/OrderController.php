<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=cart::where("client_id",session("user_id"))
                    ->where('is_watchlist',false) // Ensure this fetches only cart items
                    ->get();
        //return $items;
         return view("checkout",compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'c_email' => 'required|email',
            'c_fname' => 'required|string|min:2|max:255',
            'c_lname' => 'required|string|min:2|max:255',
            'c_phone' => 'required|regex:/^[0-9]{10}$/',
            'c_address' => 'required|string',
            'c_country' => 'required|string',
            'c_state' => 'required|string',
            'c_city' => 'required|string',
            'c_pincode' => 'required|regex:/^[0-9]{6}$/',
        ]);
    
        
            // Get the client ID
            $clientId = session('user_id');
    
            // Fetch cart items for the client
            $cartItems = Cart::where('client_id', $clientId)->get();
    
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'No items in the cart.');
            }
    
            // Calculate total items and total amount
            $totalItems = $cartItems->sum('total_qty'); // Assuming 'quantity' represents the number of each product
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->product->price * $item->total_qty; // Product price * quantity for each item
            });
    
            // Insert the order into the database
            $order = Order::create([
                'client_id'   => $clientId,
                'first_name'  => $request->c_fname,
                'last_name'   => $request->c_lname,
                'email'       => $request->c_email,
                'phone'       => $request->c_phone,
                'address'     => $request->c_address,
                'country'     => $request->c_country,
                'state'       => $request->c_state,
                'city'        => $request->c_city,
                'pincode'     => $request->c_pincode,
                'total_item'  => $totalItems,
                'total_amount'=> $totalAmount,
                'status'      => 'complete', // Default status
            ]);
            foreach ($cartItems as $cartItem) {
                Order_item::create([
                    'order_id'    => $order->order_id,  // Use the created order's order_id
                    'product_id'  => $cartItem->pro_id,
                    'qty'         => $cartItem->total_qty,
                    'final_amount'=> $cartItem->product->price * $cartItem->total_qty, // Calculate final amount for each item
                ]);
            }

            // Clear the cart for the client
            Cart::where('client_id', $clientId)->delete();
            return view('thankyou');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
    public function order(Request $request){
        $orders = Order::with(['order_item.product', 'client'])
        ->where('status', 'Pending')
        ->get();

    $productNames = [];
    foreach ($orders as $order) {
        foreach ($order->order_item as $item) {
            $productNames[] = $item->product->product_name; // Assuming 'name' is the attribute for the product's name
        }
    }
    //return $productNames;
    
    // Return the product IDs (for debugging or testing)
    //return $productIds;
        return view('order',compact('orders'));

    }
}
