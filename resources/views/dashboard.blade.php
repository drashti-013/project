@extends('layouts.adminlayout')
@section('content')
<!-- Container for the dashboard -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="container-fluid">
    
    <!-- Main content area -->
    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between mb-4">
        <h2 class="card-title">Welcome to the Admin Dashboard</h2>
        
    </div>

    <!-- Dashboard Cards -->
    
    <!-- Dashboard Content -->
    <div class="card p-4">
        <h4 class="card-title">Electronic Dashboard Overview</h4>
        <p class="card-text">This is an electronic dashboard designed for managing various system components. It allows the admin to manage users, view reports, and configure settings. The dashboard is highly interactive and supports easy navigation through the use of Bootstrap components and modern UI principles.</p>

        <h5>Key Features:</h5>
        <ul>
            <li>Real-time data analytics for better decision making.</li>
            <li>Secure user management and role assignments.</li>
            <li>Customizable settings to enhance user experience.</li>
            <li>Responsive design that works on any device.</li>
        </ul>

        <h5>Next Steps:</h5>
        <p>Click on each section to view detailed information and manage specific areas of the dashboard. Explore reports for insights, manage user data, or update settings as needed.</p>
    </div>

</div>
@endsection
@section('style')
{{-- dashboard css --}}
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
