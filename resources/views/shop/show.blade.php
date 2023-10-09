@extends('layouts.shop')
@section('content')



    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
            <div class="card">
            <div class="row">
                <div class="col-md-6">
                <div id="imgs" class="carousel slide rounded-pill mb-3" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="https://dz.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/58/2505/1.jpg?3313" class="d-block" data-toggle="lightbox" data-gallery="imageZoom">
                                <img src="{{asset('storage/' . $product->image)}}" class="img-fluid" alt="Decathlon POLO MW500 BLEU TURQUIN">
                            </a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="product p-4">
                        
                <h1 class="font-weight-bold">{{ $product->name }}</h1>
                <p>Marque: <a href="{{ route('shop.filter.brand', $product->brand) }}">{{$product->brand->name}}</a> | <a href="{{ route('shop.filter.category', $product->category) }}">Produits similaires {{$product->category->name}} </a></p>
                <h2 class="text-success font-weight-bold">{{ $product->price }} DA</h2>
                <form action="{{ route('add.to.cart', ['product' => $product->id]) }}" method="POST" onsubmit="return validateSelection()">
                    @csrf
                    <!-- Champ de couleur sélectionnée -->
                    <input type="hidden" name="selected_color" id="selected_color">

                    <!-- Champ de taille sélectionnée -->
                    <input type="hidden" name="selected_size" id="selected_size">
                    <p class="mt-3" id="selectionColorMessage"> Veuillez selectionner une couleur</p>
                    <div class="form-group">
                        <div class="btn-group" role="group" aria-label="Available Colors">
                        @foreach($colors as $color)
                            <button type="button" class="btn btn-primary" data-color="{{ $color->name }}" style="background-color: {{ $color->code }};" onclick="selectColor(this, {{ $product->id }})"></button>
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
        colorMessage.innerText = "";

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

    



    </script>
    

    @endsection
