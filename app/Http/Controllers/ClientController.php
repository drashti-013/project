<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Products = Product::with('images')->where('status',1)->paginate(3);
        //return $Products;
        //dd($Products);
        return view('shop', compact('Products'));

        // $Products = Product::with('images')->get();
        // return view('shop', compact('Products'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name'     => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'email'    => 'required|email',   
        'password' => 'required|string|min:6',
        ]);
        $client = Client::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
        ]);
        //return redirect()->route('login')->with('success','')         
        return response()->json(['success' => true, 'message' => 'Registration successful!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
    public function logout(){
        Session::flush();
        return redirect("/login")->with("error","successfully logout!!");
    }
}
