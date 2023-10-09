@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <h1>Products</h1>
    <td><a href="{{ route('products.create') }}" class="btn btn-primary">Create produit</a></td>

    <table id="productsTable" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Modifier Stock</th>
                <th>Actions</th>
                <!-- Add more columns here as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td><a href="{{ route('stock.edit', $product->id) }}" class="btn btn-primary">Edit Stock</a></td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="material-icons">&#xE872;</i>
                            </button>
                        </form>
                    </td>
                    <!-- Add more columns here as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable();
        });
    </script>
@endsection
