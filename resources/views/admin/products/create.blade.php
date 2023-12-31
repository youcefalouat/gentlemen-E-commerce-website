@extends('layouts.app')

@section('content')
<a  href="{{ route('products.index') }}" class="bi bi-arrow-return-left">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"></path>
        </svg>
</a>

<br>

<h1>Create a New Product</h1>

    <form action="{{ url('/admin/products') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>        
        <!-- Color and Photo Fields -->
        <div class="form-group" id="color-fields">
            <label for="colors">Colors</label>
            <div class="color-entry">
                <div style="display: flex; align-items: center;">
                    <select style="width: 20%;" name="color_ids[]" class="form-control" required>
                        <option value="">Selectionner une couleur</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                    <input type="file" name="color_images[]" class="form-control" accept="image/*" required>
                </div>
            </div>
        </div>
        

        <button type="button" id="add-color" class="btn btn-success">Add Color</button>


        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" step="1" required>
        </div>

        <div class="form-group">
            <label for="brand">Marque</label>
            <select name="brand_id" id="brand" class="form-control" required>
                <option value="">Selectinner une marque</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        

        <button type="submit" class="btn btn-primary">Create Product</button>
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