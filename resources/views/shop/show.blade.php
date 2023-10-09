@extends('layouts.shop')
@section('content')



    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
            <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="images p-3">
                        <div class="text-center p-4"> <img id="main-image" src="{{asset('storage/' . $product->image)}}" width="250"> </div>
                        <div class="thumbnail text-center">
                            @foreach($product->photos as $key => $photo)
                            <img onclick="change_image(this)" src="{{ asset('storage/' . $photo->image) }}" width="70"> 
                            @endforeach
                        </div>
                        </div>
                
                </div>
                <div class="col-md-6">
                    <div class="product p-4">
                        
                <h1 class="font-weight-bold">{{ $product->name }}</h1>
                <p>Marque: <a href="{{ route('shop.filter.brand', $product->brand) }}">{{$product->brand->name}}</a> | <a href="{{ route('shop.filter.category', $product->category) }}">Produits similaires {{$product->category->name}} </a></p>
                <h2 class="text-success font-weight-bold">{{ $product->price }} DA</h2>
               
                <p  class="card-text" style="font-family: 'DM Serif Display', serif; font-size: 20px;">{{$product->description}} <br> </p>
                <form action="{{ route('add.to.cart', ['product' => $product->id]) }}" method="POST" onsubmit="return validateSelection()">
                    @csrf
                    <!-- Champ de couleur sélectionnée -->
                    <input type="hidden" name="selected_color" id="selected_color">

                    <!-- Champ de taille sélectionnée -->
                    <input type="hidden" name="selected_size" id="selected_size">
                    <p class="mt-3" id="selectionColorMessage"> Veuillez selectionner une couleur</p>
                    <div class="form-group">
                        <div class="btn-group" role="group" aria-label="Available Colors">
                        @foreach($product->colors->unique('name') as $color)
                        @php
                            // Fetch the image URL for this color
                            $image = $product->photos->where('color_id', $color->id)->first();
                            $imageUrl = $image ? asset('storage/' . $image->image) : ''; // Assuming your images are in the 'storage' directory
                        @endphp
                            <button type="button" class="btn btn-primary" data-color="{{ $color->name }}" style="background-color: {{ $color->code }};"
                                data-image="{{ $imageUrl }}" onclick="selectColor(this, {{ $product->id }})"></button>
                        @endforeach
                        </div>
                    </div>
           <br><br>
                    <div class="form-group">
                        <div class="btn-group btn-group-size" role="group" aria-label="Available Sizes">
                        <div class="btn-group" role="group" aria-label="Available Sizes">
                            @foreach($categorysizes as $categorysize)
                                <button type="button" class="btn btn-primary" data-size="{{ $categorysize->size }}" onclick="selectSize(this)" disabled>{{ $categorysize->size }}</button>
                            @endforeach                        
                        </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg mt-3" name="action" value="add_to_cart">Ajouter Au Panier</button>
                    <button type="submit" class="btn btn-primary btn-lg mt-3" name="action" value="buy_now">Acheter</button>                </form>
                    <p class="mt-3" id="selectionErrorMessage" style="color: red;"></p>
             
        </div>
        
            </div>
        </div>
        </div>  
        </div>
    </div>
    @endsection
    @section('scripts')

    <script>

    function selectColor(button, productId) {
        const selectedColor = button.getAttribute("data-color");
        document.getElementById("selected_color").value = selectedColor;
        const colorMessage = document.getElementById("selectionColorMessage");
        const selectedImage = button.getAttribute("data-image");
        colorMessage.innerText = "";
        var container = document.getElementById("main-image");
        container.src = selectedImage;

        // Make an Ajax request to fetch available sizes for the selected color
        $.ajax({
            url: `products/${productId}/colors/${selectedColor}/sizes`, // Replace with the correct route
            type: "GET",
            dataType: "json",
            success: function(response) {
                updateSizeButtons(response.sizes);
            },
            error: function(error) {
                console.error("Error fetching sizes:", error);
            }
        });
}

    function updateSizeButtons(availableSizes) {
        const sizeButtons = document.querySelectorAll(".btn-group-size button");
        
        sizeButtons.forEach(button => {
            const size = button.getAttribute("data-size");
            
            // Check if the size is in the available sizes
            if (availableSizes.includes(size)) {
                button.removeAttribute("disabled");
            } else {
                button.setAttribute("disabled", true);
            }
        });
}
    function selectSize(button) {
        const selectedSize = button.getAttribute("data-size");
        document.getElementById("selected_size").value = selectedSize;
        
}

    
function validateSelection() {
    const selectedColor = document.getElementById("selected_color").value;
    const selectedSize = document.getElementById("selected_size").value;
    const errorMessage = document.getElementById("selectionErrorMessage");

    if (!selectedColor || !selectedSize) {
        errorMessage.innerText = "Veuillez selectionner une couleur et une taille disponible.";
        return false; // Prevent form submission
    }

    // If color and size are selected, clear the error message
    errorMessage.innerText = "";
    return true; // Allow form submission
}

function change_image(image){
var container = document.getElementById("main-image");
container.src = image.src;
}



    </script>
    

    @endsection
