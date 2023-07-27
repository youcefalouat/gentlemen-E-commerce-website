@extends('home')
@section('content')

<div class="album py-5 bg-body-tertiary">

    <div class="container">
      <div class="row">

        @foreach ($produits as $produit)
            
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img src="{{asset('produits/'.$produit->image)}}" class="card-img-top img-fluid" alt="Responsive image">
                <div class="card-body">
                    <p class="card-text">{{$produit->name}} <br>{{$produit->description}} </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price">{{$produit->price}} DA</span>
                        <a href="{{route('products.show',['product' => $produit->id])}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
  @endsection