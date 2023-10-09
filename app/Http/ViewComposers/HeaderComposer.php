<?php
namespace App\Http\ViewComposers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;

class HeaderComposer{
    public function compose($view){
        $view->with('categories', Category::where('active', '1')->get());
        $view->with('childcategories', Category::where('active', '1')->get());
        $view->with('brands', Brand::all());

    }
}