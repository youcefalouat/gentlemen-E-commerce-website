@extends('layouts.app')

@section('content')
    <h1>Order {{ $order->id }}</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Total Amount: ${{ $order->total_amount }}</p>
    <p>Shipping Address: {{ $order->shipping_address }}</p>
    <p>Payment Status: {{ $order->payment_status }}</p>

    <h2>Items</h2>
    <ul>
        @foreach($order->orderItems as $item)
            <li>{{ $item->product->name }} (Quantity: {{ $item->quantity }}, Subtotal: ${{ $item->subtotal }})</li>
        @endforeach
    </ul>

    <!-- Additional order details and actions -->
@endsection
