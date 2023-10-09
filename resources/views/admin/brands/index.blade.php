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

    <h1>Marques</h1>
    <td><a href="{{ route('brands.create') }}" class="btn btn-primary">Introduire une marque</a></td>

    <table id="brandsTable" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
                <!-- Add more columns here as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display: inline;">
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
            $('#brandsTable').DataTable();
        });
    </script>
@endsection
