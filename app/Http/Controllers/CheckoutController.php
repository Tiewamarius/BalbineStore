<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\order_Items;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Carts::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $cart = Carts::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            return back()->with('error', 'Panier introuvable.');
        }

        // Création de la commande
        $order = Orders::create([
            'user_id' => auth()->id(),
            'total' => $cart->total,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending'
        ]);

        foreach ($cart->items as $item) {
            order_Items::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price
            ]);
        }

        // Vider le panier
        $cart->items()->delete();
        $cart->update(['status' => 'completed']);

        return redirect()->route('cart.index')->with('success', 'Commande enregistrée avec succès !');
    }
}
