@extends('layouts.clientlayout')

@section('content')
<link href="{{ asset('css/watchlist.css') }}" rel="stylesheet">

<!-- Header -->
<div class="header">
    My Sofa Watchlist
</div>

<!-- Watchlist Container -->
<div class="container watchlist-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(!Session::has('user_id'))
    <div class="alert alert-danger">
        Login Required !<br>
        You must be logged in to view and manage your wishlist. Please log in to access your saved items and continue shopping.<br>
        <a class="text-dark" href="{{route('login')}}">Login Now</a>
    </div>
    @elseif($products->isEmpty())
        <div class="alert alert-info">
            Your wishlist is empty. Start adding products to your wishlist!
        </div>
    @else
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-6 col-sm-12">
                    <div class="sofa-card shadow-sm border rounded">
                        @php
                            $image = $product->product->images->first(); // Check if products and images exist
                        @endphp

                        @if($image)
                            <img src="{{ asset('products/' . $image->url) }}" 
                                alt="{{ $product->product->product_name }}" 
                                class="card-img-top img-fluid" 
                                style="width: 100%; height: 250px; object-fit: contain;">
                        @else
                            <img src="{{ asset('products/default.jpg') }}" 
                                class="img-fluid" 
                                alt="Default Image">
                        @endif
                        
                        <div class="sofa-info p-3">
                            <h5>{{ $product->product->product_name }}</h5>
                            <p>{{ $product->product->short_description }}</p>
                            <form action="{{ route('wishlist.remove', $product->cart_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirm('Are you sure to remove this product from your wishlist')">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
</div>
@endsection
