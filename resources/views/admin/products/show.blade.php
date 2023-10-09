@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">return</a>

    <h1>{{ $product->name }}</h1>
    @if ($product->image)
        <img style="width:150px;" src="{{asset('storage/' . $product->image)}}" class="card-img-top img-fluid"  alt="Responsive image">
    @endif
    <p>{{ $product->description }}</p>
    <p>Prix: {{ $product->price }}DA</p>

    <h2>Tailles</h2>
    <ul>
        @foreach($product->sizes->unique('size') as $size)
            <li>{{ $size->size }}</li>
        @endforeach
    </ul>

    <h2>Coleurs</h2>
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
                <li>{{ $size->size }} - Quantité: {{ $size->pivot->quantity }}</li>
            @endforeach
        </ul>
        <!-- Display color-specific photos here -->
        <div class="color-photos">
            @foreach ($product->photos->where('color_id', $color->id) as $photo)
                <img src="{{ asset('storage/' . $photo->image) }}" alt="Color Photo" style="width: 150px;">
            @endforeach
        </div>
    @endforeach
@endif

<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editer</a>
<a href="{{ route('stock.edit', $product->id) }}" class="btn btn-primary">Editer Stock</a>
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this product?')">
        Supprimer
    </button>
</form>

    <!-- Additional product details and actions -->
@endsection
