@extends('layouts.shop')
@section('content')

<div class="album py-5 bg-body-tertiary">
    <br><br>
    <center><h2>Nouveautés</h2></center> 
    <div class="container">
      <div class="row">
        @if (count($products) == 0)
            
            <center><H1><br>
                <br>pas de produits disponible a l'instant <br>
            <br></H1></center>
        @else
        @foreach ($products as $product)
        <div class="col-md-4">
            
            <div class="card mb-4 box-shadow"><button><a href="{{ route('shop.show', $product->id) }}"> </p>
                          
                <div class="special-img position-relative overflow-hidden">
                <img src="{{asset('storage/' . $product->image)}}" class="card-img-top img-fluid" alt="Responsive image">
                </div>
                <div class="card-body">
                    <p  class="card-text" style="font-family: 'DM Serif Display', serif; font-size: 20px;">{{$product->name}} <br> </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price ml-auto" style="font-family: 'Quattrocento', serif; font-size: 20px;">{{$product->price}} DA</span>
                    
                </div></a></button>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div> 
</div>

  @endsection