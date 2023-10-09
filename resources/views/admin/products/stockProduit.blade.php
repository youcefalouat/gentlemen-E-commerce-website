@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">return</a>

    <h1>Quantity Product</h1>

    <form action="{{ route('stock.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')

        <h1>{{ $product->name }}</h1>
        <div class="form-group">
            <label for="colors">Colors</label>
            <select name="color_id" id="colors" class="form-control" required>
                <option value="">Selectionner une couleur</option>                
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sizes">Sizes</label>
            <select name="size_id" id="sizes" class="form-control" required>
                <option value="">Selectionner une taille</option>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                @endforeach                
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Stock</button>
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
    </form>
@endsection
@section('after-scripts')
@endsection