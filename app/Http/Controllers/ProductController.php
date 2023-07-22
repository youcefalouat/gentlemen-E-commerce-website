<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {   
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('products.create', compact('categories','sizes','colors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'sizes' => 'required|array',
            'colors' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'colors.*' => 'exists:colors,id',
        ]);

        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        ]);

        $product->category()->associate($validatedData['category_id']);
        $product->save();

        $product->sizes()->sync($validatedData['sizes']);
        $product->colors()->sync($validatedData['colors']);

        return redirect('/products')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $products = Product::with('sizes')->get();
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($validatedData);

        return redirect('/products')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully.');
    }
}
