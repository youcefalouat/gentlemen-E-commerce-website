<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{

    public function create()
    {   
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.products.stock', compact('categories','colors'));
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|numeric|min:0',
        ]);
        
        // Find the product
        $product = Product::findOrFail($validatedData['product_id']);
        
        // Attach the data to the pivot table
        $product->colors()->syncWithoutDetaching([$validatedData['color_id'] => ['size_id' => $validatedData['size_id'], 'quantity' => $validatedData['quantity']]]);
        
        return redirect()->back()->with('success', 'quantity updated successfully.');
    }

    public function getProducts(Request $request)
    {
        $categoryId = $request->input('category_id');
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json(['products' => $products]);
    }

    public function getSizes(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        $category = Category::find($categoryId);
        
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $sizes = $category->sizes;
        
        return response()->json(['sizes' => $sizes]);
    }
    public function edit(Product $product)
    {
        $category = Category::find($product->category_id);
        $sizes = $category->sizes;
        $colors = Color::all();
        return view('admin.products.stockProduit', compact('product','sizes','colors'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|numeric',
        ]);
    
        
    $existingColorSizeCombination = $product->colors()->wherePivot('color_id', $validatedData['color_id'])
                                    ->wherePivot('size_id', $validatedData['size_id'])
                                    ->first();
    if (!$existingColorSizeCombination) {
        $product->colors()->attach($validatedData['color_id'], [
        'size_id' => $validatedData['size_id'],
        'quantity' => $validatedData['quantity'],
        ]);
    } else {
        $existingColorSizeCombination->pivot->quantity = $validatedData['quantity'];
        $existingColorSizeCombination->pivot->save();
    }

      
        // Update the pivot data for the specific color and size
       /* $product->colors()->syncWithoutDetaching([
            $validatedData['color_id'] => [
                'size_id' => $validatedData['size_id'],
                'quantity' => $validatedData['quantity'],
            ]
        ]);*/
    
        return redirect()->route('products.show', $product)->with('success', 'Product color and size updated successfully.');
    }
    
}
