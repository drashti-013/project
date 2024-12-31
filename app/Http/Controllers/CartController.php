<?php

    namespace App\Http\Controllers;

    use App\Models\cart;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;

    class CartController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            if (!Session::has('user_id')) {
                return view('cart')->with('error', 'You must log in to view products in your cart.');
            }
    
            // Fetch wishlist products for the logged-in user
            $products = Cart::with(['product.images']) // Assuming 'products' has a relation with images
                ->where('client_id', Session::get('user_id'))
                ->where('is_watchlist', false) // Ensure this fetches only cart items
                ->get();
    
            return view('cart', compact('products'));
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
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(cart $cart)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(cart $cart)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request)
        {
            
            $quantities = $request->input('quantity');
            $prices = $request->input('price');
            $productIds = $request->input('product_ids');
            foreach ($productIds as $index => $productId) {
                // Get the quantity and price for each product
                $quantity = $quantities[$index];
                $price = $prices[$index];
                $pid = $productIds[$index];


                // Find the CartProduct or the corresponding model (e.g., Cart, CartItem,
                $cartProduct = Cart::where('client_id', Session::get('user_id'))
                           ->where('pro_id', $pid) // Match product_id with the selected product
                           ->where('is_watchlist', false) // Ensure it's not a wishlist item
                           ->first();
                //return $cartProduct;
                
                // Check if the cart item exists before updating
                if ($cartProduct) {
                    // Update the product with the new quantity and total amount
                    $cartProduct->total_qty = $quantity;
                    $cartProduct->total_amount = $price * $quantity;
                    $cartProduct->save();
                    //return $cartProduct;
                    
                }else
                {
                    return redirect()->route('cart.index')->with('error', 'Cart not updated successfully!');
                }
            }return redirect()->route('order.index');

            // Return a success message or redirect as necessary
            
        }




        /**
         * Remove the specified resource from storage.
         */
        public function destroy(cart $cart)
        {
            //
        }

        public function remove($id)
        {
            // Find the cart entry (wishlist) for the logged-in user
            $cartItem = Cart::where('client_id', Session::get('user_id'))
                            ->where('cart_id', $id) // Assuming 'id' is the primary key for the Cart
                            ->where('is_watchlist', false) // Make sure it's a wishlist item
                            ->first();

            // If the item exists, delete it
            if ($cartItem) {
                $cartItem->delete();
                return redirect()->back()->with('error', 'Product removed from your cart.');
            }
            return redirect()->back()->with('error', 'Product not found in your cart.');
            // If no item found, redirect with an error
           
        }

    public function add(Request $request, $id)
    {
        // Check if the user is logged in
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'You must log in to add products to your cart.');
        }

        // Check if the product is already in the cart
        $existingItem = Cart::where('pro_id', $id)
                            ->where('client_id', Session::get('user_id'))
                            ->where('is_watchlist', false)
                            ->first();

        if ($existingItem) {
            return redirect()->back()->with('error', 'This product is already in your cart.');
        }

        // Add product to cart
        Cart::create([
            'pro_id' => $id,
            'client_id' => Session::get('user_id'),
            'is_watchlist' => false,
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}


