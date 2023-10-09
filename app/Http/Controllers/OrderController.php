<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Commandé,Confirmé,Livrés à la sociéte,Livrés au client,Retour,Annuler',
            'payement_status' => 'required|in:non payées,payées'
        ]);
    
        // Find the order by ID
        $order = Order::findOrFail($order->id);
    
        // Update the order's status
        $order->update([
            'status' => $request->input('status'),
            'payement_status' => $request->input('payement_status'),
        ]);

        return redirect()->route('orders.index')->with('success', 'Commande mis a jour avec succés.');
    }

    public function destroy(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $item) {
            $item->delete();
        }
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Commande supprimer avec succés.');
    }

}
