<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cartItems;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class WavePaymentController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user->activeCart;
        $cartItems = [];
        $subtotal = 0;
        $shipping_fee = 0;
        $total = 0;

        if ($user) {
            // Panier de l'utilisateur connecté
            if (!$cart) {
                return response()->json(['error' => 'Votre panier est vide'], 400);
            }

            $cartItems = $cart->items()->with('product')->get();
            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Votre panier est vide'], 400);
            }

            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
            $shipping_fee = 0;
            $total = $subtotal + $shipping_fee;

            // Récupération de l'adresse de livraison
            $addressId = $request->address_id ?? $user->addresses()->first()?->id;

            if (!$addressId) {
                return response()->json(['error' => 'Aucune adresse disponible pour la commande'], 400);
            }
        } else {
            // Panier en session pour utilisateur non connecté
            $cart = session()->get('cart');
            if (!$cart || empty($cart['items'])) {
                return response()->json(['error' => 'Panier vide'], 400);
            }
            $cartItems = $cart['items'];
            $subtotal = $cart['subtotal'];
            $shipping_fee = $cart['shipping_fee'];
            $total = $cart['total'];

            $addressId = null; // pas d'adresse pour un visiteur non connecté
        }

        // Création de la commande
        try {
            $order = Orders::create([
                'user_id' => $user?->id,
                'address_id' => $addressId,
                'order_number' => Orders::generateOrderNumber(),
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'shipping_fee' => $shipping_fee,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création de la commande: ' . $e->getMessage()], 500);
        }

        // Pour Wave
        if ($request->payment_method === 'wave') {
            return response()->json(['order_id' => $order->id]);
        }

        // Autres paiements
        return redirect()->route('checkout.success', $order->id);
    }




    public function pay(Orders $order)
    {
        $merchantNumber = '+2250143633011';
        $amount = number_format($order->total, 0, '', '');
        $orderNumber = $order->order_number;

        $isMobile = $this->isMobile();

        if ($isMobile) {
            return redirect("wave://pay?recipient=$merchantNumber&amount=$amount&order=$orderNumber");
        }

        $qrData = json_encode([
            'recipient' => $merchantNumber,
            'amount' => $amount,
            'order' => $orderNumber
        ]);

        return view('wave.pay', compact('order', 'qrData'));
    }

    public function success(Orders $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'paid'
        ]);

        return redirect()->route('cart.index')->with('success', 'Paiement Wave confirmé !');
    }

    private function isMobile()
    {
        $agent = request()->header('User-Agent');
        return preg_match('/android|iphone|ipad|mobile/i', $agent);
    }
}
