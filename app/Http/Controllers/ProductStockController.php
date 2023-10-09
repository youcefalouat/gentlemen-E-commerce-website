<?php

namespace App\Http\Controllers;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        return redirect()->back()->with('success', 'quantité mis a jour avec succés.');
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
        $colorsProduct = DB::table('product_photos')
                            ->where('product_id', $product->id)
                            ->pluck('color_id');
        $colors = Color::find($colorsProduct);
        return view('admin.products.stockProduit', compact('product','sizes','colors'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|numeric',
        ]);
    
        // Find the existing color/size combination for the product
        $existingColorSizeCombination = $product->colors()
            ->wherePivot('color_id', $validatedData['color_id'])
            ->wherePivot('size_id', $validatedData['size_id'])
            ->first();
        if (!$existingColorSizeCombination) {
            // If the combination doesn't exist, create it
            $product->colors()->attach($validatedData['color_id'], [
                'size_id' => $validatedData['size_id'],
                'quantity' => $validatedData['quantity'],
            ]);
        } else {
            // If the combination exists, update its quantity
            DB::table('product_colors_sizes')
                ->where('product_id', $existingColorSizeCombination->pivot->product_id)
                ->where('color_id', $existingColorSizeCombination->pivot->color_id)
                ->where('size_id', $existingColorSizeCombination->pivot->size_id)
                ->update(['quantity' => $validatedData['quantity']]);
           // $existingColorSizeCombination->pivot->quantity = $validatedData['quantity'];
           // $existingColorSizeCombination->pivot->save();
        }
          
        // Update the pivot data for the specific color and size
       /* $product->colors()->syncWithoutDetaching([
            $validatedData['color_id'] => [
                'size_id' => $validatedData['size_id'],
                'quantity' => $validatedData['quantity'],
            ]
        ]);*/
    
        return redirect()->back()->with('success', 'quantité mis a jour avec succés.');
    }
    
}
