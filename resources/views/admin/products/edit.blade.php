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

        <!-- Color and Photo Fields -->
        <div class="form-group" id="color-fields">
            <label for="colors">Colors</label>
            @foreach($product->photos as $photo)
            <div class="color-entry">
                <div style="display: flex; align-items: center;">
                    <select style="width: 20%;" name="color_ids[]" class="form-control">
                        <option value="">Select a color</option>
                        @foreach($colors as $colorOption)
                        <option value="{{ $colorOption->id }}" {{ $photo->color_id == $colorOption->id ? 'selected' : '' }}>
                            {{ $colorOption->name }}
                        </option>
                        @endforeach
                    </select>
                    <input type="file" name="color_images[]" class="form-control" accept="image/*">
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-color" class="btn btn-success">Add Color</button>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
    // Now you can safely use $ within this function
    $("#add-color").click(function () {
        var newColorEntry = $(".color-entry:first").clone();
        newColorEntry.find("select").val(""); // Clear select values
        newColorEntry.find("input").val(""); // Clear input values
        $("#color-fields").append(newColorEntry);
    });
});
</script>
@endsection
