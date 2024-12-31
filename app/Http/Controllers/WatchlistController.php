<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\cart;

class WatchlistController extends Controller
{
    public function add(Request $request,$id){
        // Check if the user is logged in
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'You must log in to add products to your wishlist.');
        }

        // Check if the product is already in the cart
        $existingItem = Cart::where('pro_id', $id)
                            ->where('client_id', Session::get('user_id'))
                            ->where('is_watchlist', true)
                            ->first();

        if ($existingItem) {
            return redirect()->back()->with('error', 'This product is already in your wishlist.');
        }

        // Add product to cart
        Cart::create([
            'pro_id' => $id,
            'client_id' => Session::get('user_id'),
            'is_watchlist' => true,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }
    public function index()
    {
        // Check if the user is logged in
        if (!Session::has('user_id')) {
            return view('watchlist')->with('error', 'You must log in to view products in your wishlist.');
        }

        // Fetch wishlist products for the logged-in user
        $products = Cart::with(['product.images']) // Assuming 'products' has a relation with images
            ->where('client_id', Session::get('user_id'))
            ->where('is_watchlist', true) // Ensure this fetches only watchlist items
            ->get();

        return view('watchlist', compact('products'));
    }
   // WishlistController.php
    public function remove($id)
    {

        // Find the cart entry (wishlist) for the logged-in user
        $cartItem = Cart::where('client_id', Session::get('user_id'))
                        ->where('cart_id', $id) // Assuming 'id' is the primary key for the Cart
                        ->where('is_watchlist', true) // Make sure it's a wishlist item
                        ->first();

        // If the item exists, delete it
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('error', 'Product removed from your wishlist.');
        }

        // If no item found, redirect with an error
        return redirect()->back()->with('error', 'Product not found in your wishlist.');
    }


}
