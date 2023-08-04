@extends('layouts.app')

@section('content')
    <h1>{{ $client->name }}</h1>
    <p>Email: {{ $client->email }}</p>

    <h2>Orders</h2>
    <ul>
        @foreach($client->orders as $order)
            <li>
                <a href="{{ route('orders.show', $order) }}">Order {{ $order->id }}</a>
            </li>
        @endforeach
    </ul>

    <!-- Additional client details and actions -->
@endsection
