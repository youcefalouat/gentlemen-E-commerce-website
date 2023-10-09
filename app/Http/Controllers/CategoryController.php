<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function getSizesByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $sizes = $category->sizes;
        
        return response()->json(['sizes' => $sizes]);
    }
}

