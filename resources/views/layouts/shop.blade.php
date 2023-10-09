<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Gentleman</title>
 <!-- Fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
 <!-- Bootstrap 5 CSS (including Bootstrap icons) -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <!-- Your Custom Styles -->
 <link href="{{ asset('Gentleman_files/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('Gentleman_files/all.min.css') }}" rel="stylesheet">

 <!-- Bootstrap 5 JavaScript (with Popper.js) -->
 <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
 <!-- jQuery (required for Bootstrap) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <link rel="shortcut icon" href="karimg.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
 
<!--
  <link rel="stylesheet" href="{{asset('Gentleman_files/bootstrap.min(1).css')}}">
  <link rel="stylesheet" href="{{asset('Gentleman_files/all.min.css')}}" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <script src="{{asset('Gentleman_files/bootstrap.bundle.min.js.téléchargement')}}" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link href="{{asset('Gentleman_files/bootstrap.min(2).css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Gentleman_files/font-awesome.min.css')}}"> 
    <script src="{{asset('Gentleman_files/jquery.min.js.téléchargement')}}"></script>-->
  <style>
  
    /* special */
.special-img span{
    top: 200px;
    right: 200px;
     object-fit: cover;
     font-family: 'Roboto', sans-serif; 
}
.special-list .btn{
    padding: 8px 20px!important;
    font-family: 'Roboto', sans-serif; 
}
.special-img img{
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
     width: 250px;
        /* You can set the dimensions to whatever you want */
        height: 250px;
        object-fit: cover;
        font-family: 'Roboto', sans-serif; 
}
.special-img:hover img{
    -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
            transform: scale(1.2);
            font-family: 'Roboto', sans-serif; 
}

      .dropdown-toggle
      {
          color: black;
          font-family: 'Roboto', sans-serif; 
      }
      .btn-primary {
      background-color: white;
      color: black;
      font-family: 'Roboto', sans-serif; 
      }
      .btn[disabled] {
      background-color: #f2f2f2; /* Background color when disabled */
      text-decoration: line-through; /* Add a line-through text decoration */
      color: #999; /* Text color when disabled */
      cursor: not-allowed; /* Change cursor to indicate it's not clickable */
      font-family: 'Roboto', sans-serif; 
      }
      .dropdown {
            position: relative;
            display: inline-block;
            font-family: 'Roboto', sans-serif; 
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            font-family: 'Roboto', sans-serif; 
        }

        .dropdown:hover .dropdown-content {
            display: block;
            font-family: 'Roboto', sans-serif; 
        }


        /* Styles for the dropright submenu */
        .dropright {
            position: relative;
            display: inline-block;
            font-family: 'Roboto', sans-serif; 
        }

        .dropright-content {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            font-family: 'Roboto', sans-serif; 
        }

        .dropright:hover .dropright-content {
            display: block;
            font-family: 'Roboto', sans-serif; 
        }

        /* Style for the menu items */
        .menu-item {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: #966F33;
            font-family: 'Roboto', sans-serif; 
        }

        .menu-item:hover {
            background-color: #ddd;
            font-family: 'Roboto', sans-serif; 
        }
        button {
            border: none;
            background-color: #FFEEF4;
            box-shadow: 0 12px 15px rgba(0,0,0,0.2);
        }
    .card-text {
  font-family: 'Roboto', sans-serif; /* Use Roboto font for card text */
}
body {
 background-color: #E4F1FF;
  font-family: 'Roboto', sans-serif; /* Use Roboto font for body text */
}

.navbar-custom {
  background-color: rgb(97, 60, 18) !important;
  position: fixed;
  padding: 10px 0;
  z-index: 1000;
  top: 0;
  width: 100%;
  background-color: #333;
  color: #fff;
  font-family: 'Roboto', sans-serif; /* Use Roboto font for the navbar */
}
/* You can apply the Italiana font to specific elements, for example: */
.navbar-brand {
  font-family: 'Italiana', cursive; /* Use Italiana font for the navbar brand */
}

.card-text {
  font-family: 'Roboto', sans-serif; /* Use Roboto font for card text */
}
h1, h2, h3, h4, h5, h6 {
  font-family: 'Italiana', cursive; /* Use Italiana font for headings */
}
.dynamic-button {
  display: inline-block;
  padding: 10px 20px;
  margin: 10px;
  background-color: #007bff; /* Change to your desired button background color */
  color: #fff; /* Change to your desired button text color */
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.dynamic-button:hover {
  background-color: #0056b3; /* Change to the hover background color you prefer */
  transform: scale(1.05); /* Add a slight scaling effect on hover */
}
.right-align {
            text-align: right;
        }
        .bold {
            font-weight: bold;
            color: red;
        }
         .extra-padding {
            padding-right: 10px; /* Adjust the amount of padding as needed */
        }
        .navbar-brand {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    font-family: 'Eagle Lake', cursive, 'Work Sans', sans-serif; /* Utilisez les polices Eagle Lake et Work Sans */
    font-size: 35px; /* Ajustez la taille de police selon vos préférences */
    color: #966F33;
}
  .col-md-4 a {
            text-decoration: none;
    }  

@media (max-width: 768px) {
  .navbar-brand {
    top: 0px;
  }
        .col-md-4 {
            display: block;
            width: 50%;
            
            /* Add margin to separate the cards */
        }

        .special-img {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px; /* Set the same height as in desktop */
        }
    }

@media (max-width: 400px) {
  .navbar-brand {
    top: 0px;
  }
        .col-md-4 {
            display: block;
            width: 50%;
            
            /* Add margin to separate the cards */
        }

        .special-img {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px; /* Set the same height as in desktop */
        }
    }    

  </style>

</head>

<body>
  <nav class="navbar navbar-custom navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('shop.index')}}">
        <img src="{{asset('Gentleman_files/logo1.png')}}" alt="Logo" width="60" height="60" style="margin-right: -10px;"> <!-- Ajoutez un espace à droite du logo -->
        <span style="vertical-align: middle;">Gentleman</span> <!-- Utilisez la propriété "vertical-align" pour aligner le texte verticalement avec le logo -->
    </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">    
            <div class="dropdown">
              <a class="menu-item" href="#">Catégories </a>
              <div class="dropdown-content">
                @foreach($categories as $category)
                  @if($category->parent_id == Null)
                    <div class="dropright">
                      <a class="menu-item" href="{{ route('shop.filter.category', $category) }}">{{ $category->name }}</a>
                        <div class="dropright-content">
                          @foreach($childcategories as $childcategory)
                            @if($childcategory->parent_id == $category->id)
                              <a class="menu-item" href="{{ route('shop.filter.category', $childcategory) }}">{{ $childcategory->name }}</a>
                            @endif
                          @endforeach 
                        </div>        
                  </div>
                  @endif
                @endforeach
              </div>
          </div>
          </li>
          <li class="nav-item">  
          <div class="dropdown">
            <a class="menu-item" href="#">Marques </a>
            <div class="dropdown-content">
              @foreach($brands as $brand)
              <a class="menu-item" href="{{ route('shop.filter.brand', $brand) }}">{{ $brand->name }}</a>
              @endforeach
            </div>
          </div>
          </li>  

        </ul>
        
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
      <a href="{{ route('shopping.cart') }}" class="nav-link">
        <i class="fas fa-shopping-cart"><span class="badge bg-danger">{{ count((array) session('cart')) }}</span></i>
      </a>
    </div>
  </nav>

  <main class="py-4">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger" style="padding-top: 50px;>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @yield('content')
</main>

  <div class="jumbotron text-center" style="background-color: #E2C799;">
    <h1>Bienvenue a la boutique Gentleman</h1>
    <p>Discover the latest fashion trends.</p>
    <a href="{{route('shop.index')}}" class="btn btn-primary">Shop Now</a>
  </div>

  <footer class="bg-secondary text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contact-Nous</h4>
                <address>
                    Gentleman<br>
                    00 rue les frère abd slami<br>
                    Kouba . 16005<br>
                    Phone: (123) 000-00000<br>
                    Email: karimex@gmail.com
                </address>
            </div>
            <div class="col-md-4">
                <h4>Heures d'ouverture</h4>
                <ul>
                    <li>Samedi - Jeudi: 10:00 - 21:00</li>
                    <li>Vendredi: Fermé</li>
                </ul>
            </div>
            <div class="col-md-4">
                <!-- Add your social media links here using Bootstrap classes -->
                <h4>Follow Us</h4>
                <a href="#" target="_blank" class="btn btn-dark mr-2">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" target="_blank" class="btn btn-dark mr-2">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" target="_blank" class="btn btn-dark mr-2">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" target="_blank" class="btn btn-dark">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
  @yield('scripts')
</body>

</html>