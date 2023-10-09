<?php

namespace App\Http\Controllers\Shop;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function getCommunes($wilayaId)
    {
        $communes = Commune::where('wilaya_id', $wilayaId)->get();
        return response()->json($communes);
    }

}