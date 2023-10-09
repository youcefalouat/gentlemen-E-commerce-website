@extends('layouts.shop')
   
@section('content')
<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-6">
            <div class="cart">
                <table id="cart" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Couleur</th>
                            <th>Taille</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <tr rowId="{{ $id }}">
                                    <td data-th="Product">
                                        <div class="row">         
                                            <div class="special-mini-img position-relative overflow-hidden">
                                                <div><img src="{{asset('storage/' . $details['image'])}}" class="card-img-top" style="width: 50px; height: 50px;"/></div>
                                            </div>
                                            <div>
                                                <p class="nomargin">{{ $details['name'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ $details['price'] }}DA</td>
                                    <td data-th="Color">{{ $details['color'] }}</td>
                                    <td data-th="Size">{{ $details['size'] }}</td>
                                    <!-- Update the HTML for Quantity -->
                                    <td data-th="Quantity" >{{ $details['quantity'] }}
                                      <!--  <input type="button" style="width: 24px; height: 24px;" value="-" class="minus">
                                       <input type="number" style="width: 30px; height: 30px;" min="1" name="quantity" value="{{ $details['quantity'] }}" title="Qty" class="input-text qty text" size="2" pattern="" inputmode="">
                                      <input type="button" style="width: 24px; height: 24px;" value="+" class="plus">
                                      --> </td>
                                    <td data-th="Subtotal" class="text-center">{{$details['price']*$details['quantity']}}</td>
                                    <td class="actions">
                                        <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right" >
                                <p class="mt-3" id="livraison"></p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Veuillez entré vos coordonnées</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('checkout')    }}">
                        @csrf
                        <!-- Your checkout form fields here -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">{{ __('Nom') }}</label>
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">{{ __('Prenom') }}</label>
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="wilaya" class="form-label">Sélectionner une Wilaya:</label>
                            <select name="wilaya" id="wilaya" class="form-select">
                                <option value="">Sélectionner une wilaya</option>
                                @foreach ($wilayas as $wilaya)
                                    <option value="{{ $wilaya->id }}">{{ $wilaya->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="commune" class="form-label">Sélectionner une commune:</label>
                            <select name="commune" id="commune" class="form-select"></select>
                        </div>
                        <input type="hidden" id="selectedCommune" name="selected_commune">
                        <div class="mb-3">
                            <label for="adresse" class="form-label">{{ __('Adresse') }}</label>
                            <input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                            @error('adresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">{{ __('Téléphone') }}</label>
                            <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" id="shippingPrice" name="shipping_price" value="">
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Envoyer la commande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
      
@section('scripts')
<script type="text/javascript">

    // Decrease quantity when the minus button is clicked
$(".minus").click(function (e) {
    e.preventDefault();
    var quantityInput = $(this).nextAll('input[type="number"]');
    var currentQuantity = parseInt(quantityInput.val());
    
    // Ensure the quantity is at least 1 before decreasing
    if (currentQuantity > 1) {
        quantityInput.val(currentQuantity - 1);
        updateCart(quantityInput);
    }
});

// Increase quantity when the plus button is clicked
$(".plus").click(function (e) {
    e.preventDefault();
    var quantityInput = $(this).prevAll('input[type="number"]');
    var currentQuantity = parseInt(quantityInput.val());
    
    // You may want to define a maximum quantity here if needed
    quantityInput.val(currentQuantity + 1);
    updateCart(quantityInput);
});

function updateCart(quantityInput) {
    var ele = quantityInput.closest("tr");
    var newQuantity = quantityInput.val();
    
    $.ajax({
        url: '{{ route('update.cart') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.attr("rowId"),
            quantity: newQuantity, // Send the new quantity to the server
        },
        success: function (response) {
            window.location.reload();
        }
    });
}

   
    $(".edit-cart-info").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("rowId"), 
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".delete-product").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    document.getElementById('wilaya').addEventListener('change', function() {
    var wilayaId = this.value;
    fetch("{{ route('getcommunes', '') }}/" + wilayaId)
        .then(response => response.json())
        .then(communesAndLivraison => {
        var communeSelect = document.getElementById('commune');
        communeSelect.innerHTML = '<option value="">Selectionner une commune</option>';
        communesAndLivraison.communes.forEach(commune => {
            var option = document.createElement('option');
            option.value = commune.id;
            option.textContent = commune.nom;
            communeSelect.appendChild(option);
        });

        // Set the selected commune ID in the hidden input field
        var selectedCommuneInput = document.getElementById('selectedCommune');
        if (communesAndLivraison.communes.length > 0) {
            selectedCommuneInput.value = communesAndLivraison.communes[0].id; // Set the first commune ID as default
        } else {
            selectedCommuneInput.value = ''; // Reset the value if no communes available
        }

        // Display the shipping price
        const livraisonprice = document.getElementById("livraison");
        livraisonprice.textContent = `Prix de livraison: ${communesAndLivraison.livraison} DA`;
        const shippingPriceInput = document.getElementById("shippingPrice");
        shippingPriceInput.value = communesAndLivraison.livraison;
    });
});
</script>
@endsection