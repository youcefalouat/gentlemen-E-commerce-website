<?php

namespace App\Http\Controllers\Shop;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Wilaya;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductPhoto;

class MainController extends Controller
{
    public function index(){
        $products = Product::all();
        $brands = Brand::all();
        $colors = Color::all();
        $categories = Category::all();
        $childcategories = Category::all();
        return view('shop.index', compact('products','brands','categories','childcategories','colors'));
    }
    public function show(Product $product)
    {
        $products = Product::with('sizes')->get();
        $productCategory = Category::find($product->category_id);
        if ($productCategory) {
            // Get the sizes associated with the product's category
            $categorysizes = $productCategory->sizes;
        } else {
            // Handle the case where the product's category is not found (you can set $categorySizes to an empty array or handle it differently)
            $categorysizes = [];
        }
        $colors = Color::all();
        $productPhotos = ProductPhoto::find($product->id);
        return view('shop.show', compact('product','categorysizes','colors','productPhotos'));
    }

    public function filterByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        return view('shop.index', compact('products'));
    }

    public function filterByBrand(Brand $brand)
    {
        $products = Product::where('brand_id', $brand->id)->get();

        return view('shop.index', compact('products'));
    }

    public function getAvailableSizes(Product $product, $colorName)
{
    // Initialize an array to store available sizes
    /*$availableSizes = [];

    foreach ($product->colors as $color) {
        // Check if the color name matches the provided colorName
        if ($color->name === $colorName) {
            foreach ($color->sizes as $size) {
                if ($size->pivot->quantity != 0 && !in_array($size, $availableSizes, true)) {
                    $availableSizes[] = $size->size;
                }
            }
        }
    }
*/
$color = $product->colors->firstWhere('name', $colorName);

if ($color) {
    $availableSizes = $color->sizes
        ->where('pivot.quantity', '>', 0)
        ->unique('size')
        ->pluck('size');
} else {
    // Handle the case where no record with the specified color name is found
    $availableSizes = [];
}
    return response()->json(['sizes' => $availableSizes]);
}


    // panier

    public function productsCart()
    {
        $wilayas = Wilaya::all();
        return view('shop.cart',compact('wilayas'));
    }

    public function addToCartP(Request $request, Product $product) 
    {
        $product = Product::findOrFail($product->id);
        $id = $product->id;
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit ajoutée aux panier!');
    }
    

    public function addToCart(Request $request ,Product $product) 
    {
        $selectedColorName = $request->input('selected_color');
        $selectedSizeName = $request->input('selected_size');

        $selectedColor = Color::where('name', $selectedColorName)->pluck('id')->first(); // Use 'first()' to get a single value
        $selectedSize = Size::where('size', $selectedSizeName)->pluck('id')->first(); // Use 'first()' to get a single value
        $action = $request->input('action');
        $combinationId = Null;
        $product = Product::findOrFail($product->id);
        $combination = DB::table('product_colors_sizes')
        ->where([
            'product_id' => $product->id,
            'color_id' => $selectedColor,
            'size_id' => $selectedSize
        ])->first();

        if ($combination) {
            // If the combination exists, get its ID
            $combinationId = $combination->id;

            // Add the combination ID to the cart or perform any cart logic
            // For example, you can store it in the session or database
            $cart = session()->get('cart', []);

            // Generate a unique identifier for the cart item based on product, color, and size
            $cartItemId = "{$product->id}_{$selectedColor}_{$selectedSize}";
    
            if(isset($cart[$cartItemId])) {
                $cart[$cartItemId]['quantity']++;
            } else {
                $cart[$cartItemId] = [
                    "combinationId" => $combinationId,
                    "name" => $product->name,
                    "color" => $selectedColorName,
                    "size" => $selectedSizeName,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image
                ];
            }
    
            session()->put('cart', $cart);
            if ($action === 'add_to_cart') {
            return redirect()->back()->with('success', 'Produit ajoutée aux panier!');
            }elseif ($action === 'buy_now') {
                return redirect()->route('shopping.cart');
            }// Respond with a success message or relevant data
        }else {
            // Handle the case where the combination does not exist
            return response()->json(['error' => 'Combination not found.']);
        }
       
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Produit ajoutée aux panier!.');
        }
    }
   
    public function deleteCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produit supprimer du panier!.');
        }
    }

}
