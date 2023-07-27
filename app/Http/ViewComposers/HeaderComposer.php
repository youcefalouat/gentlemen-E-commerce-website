<?php
namespace App\Http\ViewComposers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;

class HeaderComposer{
    public function compose($view){
        $view->with('categories', Category::all());
        $view->with('brands', Brand::all());

    }
}