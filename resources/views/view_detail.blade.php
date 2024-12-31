<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Main Product Image */
        .main-image {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            height: 500px;
            padding: 45px;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .main-image:hover img {
            transform: scale(1.1);
        }

        /* Thumbnails */
        .thumbnail-container {
            margin-top: 15px;
        }

        .thumbnail-container .thumbnail {
            cursor: pointer;
            border: 1px solid #ddd;
            margin: 5px;
            transition: transform 0.2s ease, outline 0.3s ease;
        }

        .thumbnail-container .thumbnail:hover {
            transform: scale(1.1);
            outline: 3px solid #007bff;
        }

        /* Product Info */
        .product-info {
            padding-left: 20px;
            padding-top: 20px;
        }

        .product-info h1 {
            font-size: 2.5rem;
            font-family: math;
            color: #333;
        }

        .product-info p {
            font-size: 1.1rem;
            color: #555;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: bold;
            color: #28a745;
        }

        /* Add to Cart Button */
        .btn-cart {
            font-size: 1.2rem;
            padding: 12px 30px;
            background-color: #ff6f61;
            border: none;
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-cart:hover {
            background-color: #e65a50;
            transform: scale(1.05);
        }

        /* Buy Now Button */
        .btn-buy {
            font-size: 1.2rem;
            padding: 12px 30px;
            background-color: #f8c102;
            border: none;
            color: #333;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            
        }

        .btn-buy:hover {
            background-color: #d4a902;
            transform: scale(1.05);
        }

        /* Rating Badge */
        .product-rating {
            margin-top: 10px;
        }

        .product-rating span {
            font-size: 1.1rem;
            color: #ffd700;
        }

        .product-rating .badge {
            background-color: #f8d102;
        }

        /* Collapsible Description */
        .collapse-description {
            max-height: 150px;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .collapse-description.expanded {
            max-height: 5000px;
        }

        /* Smooth Scroll & Hover Effect */
        .smooth-scroll {
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }
        .header .close-icon {
                font-size: 2.5rem;
                color: #3b5d50;
                cursor: pointer;
                margin-left: auto;
                text-decoration: none;
            }

            .header .close-icon:hover {
                font-size: 2.5rem;
                color:#3b5d50; /* Slight variation in green */
            }

        .smooth-scroll:hover {
            transform: scale(1.05);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .product-images {
                text-align: center;
            }

            .product-info {
                padding-left: 0;
            }

            .btn-group {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .btn-group .btn {
                margin-bottom: 10px;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .product-rating span {
                font-size: 1rem;
            }
            
        }
    </style>
</head>

<body>
    <div class="header text-end container">
        <a href="{{ route('client.index')}}"class="close-icon">&times;</a>
    </div>
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
        <div class="row">
            <h1 class="text-center" style="font-family: 'fantasy';color: #3b5d50;">{{ $product->product_name }}</h1>
            <hr>
            <!-- Left Column: Product Image -->
            <div class="col-md-6">
                <div class="product-images">
                    <!-- Main Image -->
                    <div class="main-image">
                        <img id="main-product-image" src="{{ asset('products/' . $product->images->first()->url) }}" alt="Product Image" class="img-fluid" style="object-fit: contain">
                    </div>

                    <!-- Thumbnails -->
                    <div class="thumbnail-container d-flex flex-wrap justify-content-start mt-3">
                        @foreach($product->images as $image)
                            <div class="col-3">
                                <img src="{{ asset('products/' . $image->url) }}" alt="Thumbnail" class="img-fluid thumbnail" onmouseover="changeMainImage(this)">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Info -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{ $product->product_name }}</h1>
                    <p class="product-description">{{ $product->short_description }}</p>
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>

                    <!-- Collapsible Long Description -->
                    <p class="text-danger mt-3">About this product:</p>
                    <div id="long-description" class="collapse-description">
                        <p>{{ $product->long_description }}</p>
                    </div>
                    <button class="btn btn-link" onclick="toggleDescription()">Read More</button>
                        <br>
                    <form action="/client/cart/{{$product->product_id}}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-cart w-100 mt-3">Add to Cart</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeMainImage(thumb) {
            var mainImage = document.getElementById("main-product-image");
            mainImage.src = thumb.src;
        }

        function toggleDescription() {
            var description = document.getElementById("long-description");
            description.classList.toggle("expanded");
            var button = document.querySelector("button");
            if (description.classList.contains("expanded")) {
                button.innerHTML = "Read Less";
            } else {
                button.innerHTML = "Read More";
            }
        }
    </script>
</body>

</html>
