@extends('layouts.app')

@section('content')
<a href="{{ route('orders.index') }}" class="btn btn-primary">Retour</a>

    <h1>Order {{ $order->id }}</h1>
    <h5>Nom Client: {{ $order->nom }} {{ $order->prenom }}</h5>
    <h5>Wilaya: {{ $order->wilaya->nom  }}</h5>
    <h5>Commune: {{ $order->commune->nom  }}</h5>
    <h5>Address Client: {{ $order->shipping_address }}</h5>
    <h5>Telephone Client: {{ $order->telephone }}</h5>
    <h5>Status: {{ $order->status }}</h5>
    <h5>Total Amount: {{ $order->total_amount }}DA</h5>
    <h5>Payment Status: {{ $order->payment_status }}</h5>

    <h2>Items</h2> 
    <table id="order_items_Table" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Couleur</th>
                <th>Taille</th>
                <!-- Add more columns here as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
        @php
        // Retrieve product information using the product_colors_sizes_id
            $productInfo = DB::table('product_colors_sizes')
                ->join('products', 'product_colors_sizes.product_id', '=', 'products.id')
                ->where('product_colors_sizes.id', $item->product_colors_sizes_id)
                ->select('products.name as product_name')
                ->first();
        @endphp
         <tr>
                    <td>{{ $productInfo->product_name }} </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}DA</td>
                    <td>{{$item->color}}</td>
                    <td>{{$item->size}}</td>
                    
                    <!-- Add more columns here as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <!-- Additional order details and actions -->
@endsection
