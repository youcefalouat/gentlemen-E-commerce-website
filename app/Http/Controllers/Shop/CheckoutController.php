<?php

namespace App\Http\Controllers\Shop;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Order;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function getCommunes($wilayaId)
{
    switch ($wilayaId) {
        case '1':
        case '8':
        case '11':
        case '33':
        case '37':
        case '52':
        case '53':
        case '56':
        case '57':
        case '58':
            $livraison = 1200;
            break;
        case '3':
        case '7':
        case '12':
        case '17':
        case '30':
        case '32':
        case '39':
        case '45':
        case '47':
        case '49':
        case '50':
        case '51':
        case '55':
            $livraison = 900;
            break;
        case '4':
        case '5':
        case '13':
        case '14':
        case '18':
        case '20':
        case '21':
        case '22':
        case '24':
        case '28':
        case '29':
        case '36':
        case '38':
        case '40':
        case '41':
        case '43':
        case '46':
        case '48':
            $livraison = 800;
            break;
        case '2':
        case '6':
        case '9':
        case '10':
        case '15':
        case '19':
        case '23':
        case '25':
        case '26':
        case '27':
        case '31':
        case '34':
        case '35':
        case '42':
        case '44':
            $livraison = 500;
            break;
        case '16':
            $livraison = 400;
            break;
    }
    

    $communes = Commune::where('wilaya_id', $wilayaId)->get();

    return response()->json(['communes' => $communes, 'livraison' => $livraison]);
}

    public function checkout(Request $request)
    {
        dd($request);
    }

    public function createOrder(Request $request)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Le panier est vide. Vous ne pouvez pas passer de commande avec un panier vide.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'wilaya' => 'required|exists:wilayas,id', // Ensure wilaya ID exists in the 'wilayas' table
            'commune' => 'required|exists:communes,id', // Ensure commune ID exists in the 'communes' table
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|regex:/^0\d{9}$/|min:10|max:10',
            'shipping_price' => 'required|numeric', // Ensure shipping price is a numeric value
        ]);
        // Create a new order
    $order = new Order();
    $order->nom = $request->input('nom');
    $order->prenom = $request->input('prenom');
    $order->shipping_address = $request->input('adresse');
    $order->telephone = $request->input('telephone');

    $order->wilaya()->associate($request->input('wilaya'));
    $order->commune()->associate($request->input('commune')) ;

    $order->save(); 
    // Calculate the total order amount, including shipping
    $orderTotal = 0;

    foreach ($cart as $cartItemId => $cartItem) {
        $quantity = (int)DB::table('product_colors_sizes')
                    ->where('id', $cartItem['combinationId'])
                    ->value('quantity');

        if ($quantity == 0 || $quantity < 0) {
            $Items = OrderItem::where('order_id', $order->id)->get();
            foreach ($Items as $item) {
                $item->delete();
            }
            $order->delete();
            session()->forget('cart');
            return redirect()->route('shop.index')->withErrors(['Le stock d\'un des produit que vous essayer achetez est épuisée.']);
        }
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_colors_sizes_id = $cartItem['combinationId'];
        $orderItem->color = $cartItem['color'];
        $orderItem->size = $cartItem['size'];
        $orderItem->quantity = $cartItem['quantity'];
        $orderItem->price = $cartItem['price'];
        $orderItem->save();

        // Add the item price to the order total
        $orderTotal += ($cartItem['price'] * $cartItem['quantity']);

        // Update the product_colors_sizes table to subtract the purchased quantity
        DB::table('product_colors_sizes')
            ->where('id', $orderItem->product_colors_sizes_id)
            ->decrement('quantity', $orderItem->quantity);
    }

    // Get the shipping price from the request
    $shippingPrice = $request->input('shipping_price');

    // Add the shipping price to the order total
    $orderTotal += $shippingPrice;

    $order->total_amount = $orderTotal;
    $order->save();

    // Clear the cart
    session()->forget('cart');
    
        // Redirect or respond as needed
        return redirect()->route('shop.index')->with('success', 'Commande crée avec succés.');
    }
    
    
    

}