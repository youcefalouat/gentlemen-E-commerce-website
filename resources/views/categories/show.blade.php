@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h2>Products</h2>
    <ul>
        @foreach($category->products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
