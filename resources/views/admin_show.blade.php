@extends('layouts.adminlayout')

@section('content')
<!-- Start Hero Section -->
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
           
                    <h1 class="text-center text-primary">Products</h1>
                    
             
            <hr>
            <div class="col-lg-7">
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Cards Section -->
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="row">
        @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 mb-4"> <!-- Display 3 columns in 1 row -->
            <div class="card shadow-sm border-light rounded position-relative">
                <!-- Watchlist Icon (Top Right Corner) -->
                
                
                @php
                    $image = $product->images->first();
                @endphp

                @if($image)
                    <img src="{{ asset('products/' . $image->url) }}" alt="{{ $product->product_name }}" 
                        class="card-img-top img-fluid" style="width: 100%; height: 250px; object-fit: contain;">
                @else
                    <img src="{{ asset('products/default.jpg') }}" class="img-fluid product-thumbnail">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="card-text"><span class="rupee-icon">₹</span> {{ $product->price }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Add to Cart Button -->
                        <form action="" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="addToCart({{ $product->product_id }})">
                                <i class="bi bi-cart-trash"></i> Delete
                            </button>
                        </form>
                        <!-- View Detail Button -->
                        <a href="" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-cart-edit"></i>Update
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End Product Cards Section -->

@endsection