@extends('home')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }}DA</p>

    <h2>Sizes</h2>
    <ul>
        @foreach($product->sizes as $size)
            <li>{{ $size->name }}</li>
        @endforeach
    </ul>

    <h2>Colors</h2>
    <ul>
        @foreach($product->colors as $color)
            <li>{{ $color->name }}</li>
        @endforeach
    </ul>

    <!-- Additional product details and actions -->
@endsection
