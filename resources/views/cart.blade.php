@extends('layouts.clientlayout')  
@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->
<div class="container py-5">
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
    <div class="alert alert-danger mt-4 container">
        Login Required !<br>
        You must be logged in to view and manage your cart. Please log in to access your saved items and continue shopping.<br>
        <a class="text-dark" href="{{route('login')}}">Login Now</a>
    </div>
    @elseif($products->isEmpty())
        <div class="alert alert-info mt-4 container">
            Your cart is empty. Start adding products to your cart!
        </div>
    @else
        <div class="untree_co-section before-footer-section">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                @php
                                                    $image = $product->product->images->first(); // Check if products and images exist
                                                @endphp

                                                @if($image)
                                                    <img src="{{ asset('products/' . $image->url) }}" alt="{{ $product->product->product_name }}">
                                                @else
                                                    <img src="{{ asset('products/default.jpg') }}" class="img-fluid" alt="Default Image">
                                                @endif
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $product->product->product_name }}</h2>
                                            </td>
                                            <td class="product-price" data-price="{{ $product->product->price }}">
                                                ${{ $product->product->price }}
                                            </td>
                                            <td class="product-quantity">
                                                <div class="input-group quantity-group">
                                                    <button type="button" class="btn btn-outline-dark btn-sm decrease">-</button>
                                                    <input type="number" name="quantity[]" class="form-control text-center quantity-amount" value="{{ $product->quantity ?? 1 }}" min="1">
                                                    <button type="button" class="btn btn-outline-dark btn-sm increase">+</button>
                                                </div>
                                            </td>
                                            <td class="product-total">
                                                $<span class="total-price">{{ $product->product->price }}</span>
                                            </td>
                                            <td class="product-remove">
                                                <form action="{{ route('cart.remove', $product->cart_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure to remove this product from your cart?')">X</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <a href="{{ route('client.index')}}" class="btn btn-black btn-sm btn-block">Update Cart</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('client.index')}}" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-black">Apply Coupon</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black" id="cart-subtotal"></strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black" id="cart-total"></strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('cart.update', $product->cart_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Include hidden inputs for the quantities, prices, and other data -->
                                            @foreach($products as $product)
                                                <input type="hidden" name="product_ids[]" value="{{ $product->product->product_id }}">
                                                <input type="hidden" name="quantity[]" class="form-control text-center quantity-amount" value="{{ $product->quantity ?? 1 }}" min="1">
                                                <input type="hidden" name="price[]" class="form-control text-center" value="{{ $product->product->price }}">
                                            @endforeach
                                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
    const updateCartTotal = () => {
        let subtotal = 0;

        document.querySelectorAll('tbody tr').forEach(row => {
            const price = parseFloat(row.querySelector('.product-price').getAttribute('data-price'));
            const quantity = parseInt(row.querySelector('.quantity-amount').value);
            const total = price * quantity;

            row.querySelector('.total-price').textContent = total.toFixed(2);
            subtotal += total;
        });

        document.getElementById('cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('cart-total').textContent = `$${subtotal.toFixed(2)}`;
    };

    const handleQuantityChange = (event) => {
        const input = event.target;
        let quantity = parseInt(input.value);

        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            input.value = quantity;
        }

        updateCartTotal();
    };

    document.querySelectorAll('.quantity-amount').forEach(input => {
        input.addEventListener('change', handleQuantityChange);
    });

    document.querySelectorAll('.increase').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-group').querySelector('.quantity-amount');
            input.value = parseInt(input.value) + 1;
            input.dispatchEvent(new Event('change'));
        });
    });

    document.querySelectorAll('.decrease').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-group').querySelector('.quantity-amount');
            input.value = Math.max(1, parseInt(input.value) - 1);
            input.dispatchEvent(new Event('change'));
        });
    });

    updateCartTotal(); // Initialize totals on page load.

    const form = document.querySelector('form[action="{{ route('cart.update', $product->cart_id) }}"]');

    form.addEventListener('submit', function(e) {
        document.querySelectorAll('.quantity-amount').forEach((input, index) => {
            form.querySelectorAll('input[name="quantity[]"]')[index].value = input.value;
        });
    });
});

            </script>
           
    @endif

@endsection
