<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {   
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.products.create', compact('categories','brands','colors'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'color_ids' => 'required|array',
            'color_ids.*' => 'required|exists:colors,id',
            'color_images' => 'required|array',
            'color_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'price' => $validatedData['price'],
        ]);

        $product->category()->associate($validatedData['category_id']);
        $product->brand()->associate($validatedData['brand_id']);
        $product->save();

        // Save color photos
    $colors = $validatedData['color_ids'];
    $colorImages = $validatedData['color_images'];

    $now = now(); // Get the current date and time
    $dateString = $now->format('d/m/Y'); // Format it as 'day/month/year'

    foreach ($colors as $key => $colorId) {
        $imageName = "{$product->name}_{$product->id}_{$colorId}_{$dateString}.jpg";
        $colorPhoto = new ProductPhoto();
        $colorPhoto->product_id = $product->id;
        $colorPhoto->color_id = $colorId;
        $colorPhoto->image = $colorImages[$key]->storeAs("product_images/{$product->id}",$imageName, 'public');
        $colorPhoto->save();
    }

        return redirect()->back()->with('success', 'Produit crée avec succés.');
    }

    public function show(Product $product)
    {
        $products = Product::with('sizes')->get();
        
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.products.edit', compact('product','categories','brands','colors'));
    }

    public function updateProduct(Request $request, Product $product)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);
       

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }
        

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image' => isset($validatedData['image']) ? $validatedData['image'] : $product->image,
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
        ]);
        
        return redirect()->back()->with('success', 'Produit éditée.');
    }

    public function destroy(Product $product)
    {
        $productPhotos = ProductPhoto::where('product_id', $product->id)->get();
        foreach ($productPhotos as $photo) {
            $photo->delete();
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimée.');
    }
}
