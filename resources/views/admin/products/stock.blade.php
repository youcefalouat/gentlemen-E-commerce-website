@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">return</a>

    <h1>Quantity Product</h1>

    <form action="{{ url('/stock') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="">Selectinner une category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="products">Produit</label>
            <select name="product_id" id="products" class="form-control" required>
                <option value="">Selectionner un produit</option>                
            </select>
        </div>

        <div class="form-group">
            <label for="sizes">Sizes</label>
            <select name="size_id" id="sizes" class="form-control" required>
                <option value="">Selectionner une taille</option>                
            </select>
        </div>
        
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
            <label for="quantity">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection
@section('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the category and sizes dropdown elements
        var categoryDropdown = document.getElementById('category');
        var sizesDropdown = document.getElementById('sizes');
        var productsDropdown = document.getElementById('products');
        // Store the original sizes dropdown options
        var originalSizesOptions = sizesDropdown.innerHTML;
        var originalProductsOptions = productsDropdown.innerHTML;
        // Add an event listener to the category dropdown
        categoryDropdown.addEventListener('change', function () {
            // Get the selected category ID
            var selectedCategoryId = categoryDropdown.value;

            // Reset the sizes dropdown to its original options
            sizesDropdown.innerHTML = originalSizesOptions;
            productsDropdown.innerHTML = originalProductsOptions;
            // If a category is selected, fetch its associated sizes
            if (selectedCategoryId !== '') {
//to modify
fetch(`/gentlemen/public/get-products?category_id=${selectedCategoryId}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Append the fetched products to the products dropdown
        data.products.forEach(product => {
            var option = document.createElement('option');
            option.value = product.id;
            option.textContent = product.name;
            productsDropdown.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching products:', error);
    });

// Fetch sizes based on the selected category
fetch(`/gentlemen/public/get-sizes?category_id=${selectedCategoryId}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Append the fetched sizes to the sizes dropdown
        data.sizes.forEach(size => {
            var option = document.createElement('option');
            option.value = size.id;
            option.textContent = size.size;
            sizesDropdown.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching sizes:', error);
    });
            }
        });
    });
</script>
@endsection