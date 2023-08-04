@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
