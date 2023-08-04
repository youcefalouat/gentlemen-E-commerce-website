@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }}DA</p>

    <h2>Sizes</h2>
    <ul>
        @foreach($product->sizes as $size)
            <li>{{ $size->size }}</li>
        @endforeach
    </ul>

    <h2>Colors</h2>
    <ul>
        @foreach($product->colors->unique('name') as $color)
            <li>{{ $color->name }}</li>
        @endforeach
    </ul>
    
    @if ($product->colors)
    @foreach ($product->colors->unique('name') as $color)
        <h3>{{ $color->name }}</h3>
        @if ($product->sizes)
            @foreach ($product->sizes as $size)
                <p>{{ $size->size }} - Quantity: {{ $size->pivot->quantity }}</p>
            @endforeach
        @endif
    @endforeach
@endif



    <!-- Additional product details and actions -->
@endsection
