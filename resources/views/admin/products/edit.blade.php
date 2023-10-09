@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">return</a>

    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            @if($product->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $product->image) }}" style="max-width: 150px;max-height: 150px;width: auto; height: auto;" alt="Product Image" class="img-thumbnail">
                </div>
            @endif
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div> 

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" step="1" required>
        </div>

        <div class="form-group">
            <label for="brand">Marque</label>
            <select name="brand_id" id="brand" class="form-control" required>
                <option value="">Selectinner une marque</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" @if($brand->id === $product->brand_id) selected @endif>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id === $product->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Include other fields as needed -->

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection

@section('after-scripts')
<script>
    // JavaScript logic for fetching and updating sizes dropdown based on selected category
    // This part of the script can remain the same as your create view
</script>
@endsection
