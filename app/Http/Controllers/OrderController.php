<?php

namespace App\Http\Controllers;

use App\Models\Orders;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders();

        // Filtre par statut si présent
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();

        return view('profile.orders.index', compact('orders'));
    }


    public function show(Orders $order)
    {
        // sécurité : l'user ne peut voir que ses propres commandes
        abort_if($order->user_id !== auth()->id(), 403);

        return view('profile.orders.show', compact('order'));
    }
}
