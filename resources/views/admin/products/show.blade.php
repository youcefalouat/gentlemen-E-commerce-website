@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">return</a>

    <h1>{{ $product->name }}</h1>
    @if ($product->image)
        <img style="width:150px;" src="{{asset('storage/' . $product->image)}}" class="card-img-top img-fluid"  alt="Responsive image">
    @endif
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }}DA</p>

    <h2>Sizes</h2>
    <ul>
        @foreach($product->sizes->unique('size') as $size)
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
        <ul>
            @foreach ($color->sizes as $size)
                <li>{{ $size->size }} - Quantity: {{ $size->pivot->quantity }}</li>
            @endforeach
        </ul>
    @endforeach
@endif

<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
<a href="{{ route('stock.edit', $product->id) }}" class="btn btn-primary">Edit Stock</a>


    <!-- Additional product details and actions -->
@endsection
