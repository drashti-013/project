@extends('layouts.adminlayout')
@section('content')
{{-- order --}}
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="text-center">Admin Order Management</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header order-header text-center">
                    <h4><i class="fas fa-box"></i> Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Client Details</th>
                                <th scope="col">Location</th>
                                <th scope="col">Order Details</th>
                                <th scope="col">Product Information</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>
                                        <strong>{{ $order->client->name }}</strong><br>
                                        Email: {{ $order->email }}<br>
                                        Phone: {{$order->phone}}
                                    </td>
                                    <td>
                                        {{$order->address}}<br>
                                        {{$order->city}}, {{$order->state}}, {{$order->country}}<br>
                                        Pincode: {{$order->pincode}}
                                    </td>
                                    <td>
                                        Items: {{$order->total_item}}<br>
                                        Total: {{$order->total_amount}}
                                    </td>
                                    <td>
                                        @foreach($order->order_item as $item)
                                            Product:  {{ $item->product->product_name }} (Qty:  {{$item->qty}} )<br>
                                        @endforeach
                                    </td>
                                    <td><span class="badge bg-success">{{ $order->status }}</span></td>    
                                </tr>   
                            @endforeach
                            
                            <!-- Additional rows can be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
