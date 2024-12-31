<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email_log'    => 'required|email',
            'password_log' => 'required|string|min:6',
        ]);

        // Check client table
        $user = DB::table('clients')->where('email', $request->email_log)->first();

        // Check admin table
        $admin = DB::table('admins')->where('email', $request->email_log)->first();

        // Authenticate Client
        if ($user && $user->password === $request->password_log) {
            session(key: ['user_id' => $user->client_id]);
            $Products = Product::with('images')->get();
            return redirect()->route('client.index',compact('Products'))->with('success', 'Login successful!');
        }
        // Authenticate Admin
        else if ($admin && $admin->password === $request->password_log) {
            session(['admin_id' => $admin->admin_id]);

            return redirect('/dashboard');
        }

        // Authentication Failed
        // return redirect('')->(['email' => 'Invalid credentials. Please try again.']);
        return redirect()->route('login')->with('error','Invalid credentials. Please try again.');
    }

}