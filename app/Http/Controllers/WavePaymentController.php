<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class WavePaymentController extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        // Récupération du panier actif
        $cart = Carts::with('items.product')
            ->where('user_id', $user ? $user->id : null)
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            return response()->json(['error' => 'Panier introuvable'], 404);
        }

        // Création commande
        $order = Orders::create([
            'user_id' => $user ? $user->id : null,
            'address_id' => $user && $user->address_id ? $user->address_id : null,
            'order_number' => Orders::generateOrderNumber(),
            'payment_method' => $request->payment_method,
            'subtotal' => $cart->subtotal,
            'shipping_fee' => $cart->shipping_fee,
            'total' => $cart->total,
        ]);

        // Retour JSON pour Wave
        if ($request->payment_method === 'wave') {
            return response()->json(['order_id' => $order->id]);
        }

        // Autres paiements
        return redirect()->route('checkout.success', $order->id);
    }

    public function pay(Orders $order)
    {
        // URL Wave Mobile Money
        $merchantNumber = '+2250143633011'; // Remplace par ton numéro Wave
        $amount = number_format($order->total, 0, '', ''); // montant en FCFA
        $orderNumber = $order->order_number;

        $isMobile = $this->isMobile();

        if ($isMobile) {
            // redirection deep link Wave App mobile
            $url = "wave://pay?recipient=$merchantNumber&amount=$amount&order=$orderNumber";
            return redirect($url);
        }

        // Desktop → affichage QR code
        // Génération du QR code Wave
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
