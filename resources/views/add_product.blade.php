@extends('layouts.adminlayout')
@section('content')

   {{-- add product css  --}}
   <link rel="stylesheet" href="{{ asset('css/add_product.css') }}">
<div class="container add-product-page">
    <h1 class="title">Add Product</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Product Add Form -->
    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- General Product Information -->
        <div class="card mb-4">
            <div class="card-header">Product Details</div>
            <div class="card-body">
                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" 
                               class="form-control @error('product_name') is-invalid @enderror" 
                               id="productName" 
                               name="product_name" 
                               value="{{ old('product_name') }}"
                               placeholder="Enter product name" 
                               required>
                        @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" 
                               class="form-control @error('price') is-invalid @enderror" 
                               id="productPrice" 
                               name="price" 
                               value="{{ old('price') }}"
                               placeholder="Enter price" 
                               required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Category Dropdown -->
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" 
                                id="productCategory" 
                                name="category_id" 
                                required>
                            <option value="" selected hidden>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    {{-- @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6 mb-3">
                        <label for="productUnit" class="form-label">Unit</label>
                        <input type="text" 
                               class="form-control @error('unit') is-invalid @enderror" 
                               id="productUnit" 
                               name="unit" 
                               value="{{ old('unit') }}"
                               placeholder="Enter unit (e.g., Kg, Piece)">
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Descriptions -->
        <div class="card mb-4">
            <div class="card-header">Product Descriptions</div>
            <div class="card-body">
                <!-- Short Description -->
                <div class="mb-3">
                    <label for="shortDescription" class="form-label">Short Description</label>
                    <input type="text" 
                           class="form-control @error('short_description') is-invalid @enderror" 
                           id="shortDescription" 
                           name="short_description" 
                           value="{{ old('short_description') }}"
                           placeholder="Brief product description">
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Long Description -->
                <div class="mb-3">
                    <label for="longDescription" class="form-label">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" 
                              id="longDescription" 
                              name="long_description" 
                              rows="4"
                              placeholder="Detailed product description">{{ old('long_description') }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Images and Status -->
        <div class="card mb-4">
            <div class="card-header">Additional Details</div>
            <div class="card-body">
                <!-- Product Images -->
                <div class="mb-3">
                    <label for="productImages" class="form-label">Product Images</label>
                    <input type="file" 
                           class="form-control @error('images') is-invalid @enderror" 
                           id="productImages" 
                           name="images[]" 
                           multiple>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Product Status Switch -->
                <div class="status-switch">
                    <label for="statusSwitch" class="form-label me-2">Status:</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="statusSwitch" 
                               name="status" 
                               {{ old('status') ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Active</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save"></i> Save Product
            </button>
        </div>
    </form>
</div>
@endsection
