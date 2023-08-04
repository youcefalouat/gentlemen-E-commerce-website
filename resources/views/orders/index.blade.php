@extends('layouts.app')

@section('content')
    <h1>Orders</h1>

    <ul>
        @foreach($orders as $order)
            <li>
                <a href="{{ route('orders.show', $order) }}">Order {{ $order->id }}</a>
            </li>
        @endforeach
    </ul>
@endsection
