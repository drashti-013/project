@extends('layouts.adminlayout')
@section('content')
{{-- category --}}
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
<div class="main-content">
    <h1 align="center">Add New Sofa Category</h1>
        
    <!-- Form to Add Category -->
    <div class="form-container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category-name">Category Name</label>
                <input type="text" id="category-name" name="category_name" class="form-control" placeholder="Enter category name" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
</div>
@endsection