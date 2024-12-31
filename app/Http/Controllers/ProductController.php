<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->get();
        
        return view("admin_show", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories from the database
        return view('add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            //'category_id'=> 'required|exists:categories,category_name',
            'unit' => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable'
        ]);

        

        // Insert product data into the database
        $Product=Product::create( [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'catgory_id' => $request->category_id,
            'unit' => $request->unit,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'status' => $request->status ? 1 : 0
        ]);
        // $imagePaths = [];
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('products', 'public'); // Store images in the public storage folder
        //         $imagePaths[] = $path;
        //     }
        // }

        // Handle file upload (multiple files)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $imagename = time() . '-' . uniqid() . '.' . $file->extension();
                    $file->move(public_path('products'), $imagename); // Store images in the public 'products' directory
    
                    // Store image data in the database
                    ProductImage::create([
                        'product_id' => $Product->product_id, // Corrected 'product_id' column name
                        'url' => $imagename, // Store the file name (or path relative to the public folder)
                    ]);
                }
            }
        }
        // Redirect with success message
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product=Product::find( $product->product_id );
        return view('view_detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
