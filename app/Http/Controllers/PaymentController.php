<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\cartItems;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    /**
     * -----------------------------------------------------------
     * 1️⃣ CRÉATION DE COMMANDE (Checkout + Préparation Paiement)
     * -----------------------------------------------------------
     */
    public function store(Request $request)
    {
        $user   = Auth::user();
        $cart   = $user?->activeCart;
        $items  = [];
        $subtotal = 0;
        $shipping_fee = 0;
        $total = 0;

        /**
         *  Cas 1 : Utilisateur connecté
         */
        if ($user) {
            if (!$cart) {
                return response()->json(['error' => 'Votre panier est vide'], 400);
            }

            $items = $cart->items()->with('product')->get();

            if ($items->isEmpty()) {
                return response()->json(['error' => 'Votre panier est vide'], 400);
            }

            $subtotal = $items->sum(fn($item) => $item->quantity * $item->product->price);
            $total = $subtotal + $shipping_fee;

            // Adresse de livraison
            $addressId = $request->address_id ?? $user->addresses()->first()?->id;

            if (!$addressId) {
                return response()->json(['error' => 'Aucune adresse disponible pour la commande'], 400);
            }
        }

        /**
         *  Cas 2 : Visiteur NON connecté (panier en session)
         */
        else {
            $cart = session()->get('cart');

            if (!$cart || empty($cart['items'])) {
                return response()->json(['error' => 'Panier vide'], 400);
            }

            $items        = $cart['items'];
            $subtotal     = $cart['subtotal'];
            $shipping_fee = $cart['shipping_fee'];
            $total        = $cart['total'];
            $addressId    = null;
        }

        /**
         *  Création de la commande
         */
        try {
            $order = Orders::create([
                'user_id'        => $user?->id,
                'address_id'     => $addressId,
                'order_number'   => Orders::generateOrderNumber(),
                'status'         => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'subtotal'       => $subtotal,
                'shipping_fee'   => $shipping_fee,
                'total'          => $total,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création de la commande: ' . $e->getMessage()
            ], 500);
        }

        /**
         *  Si Wave → retour JSON pour JS (redirection)
         */
        if ($request->payment_method === 'wave') {
            return response()->json(['order_id' => $order->id]);
        }

        /**
         *  Autres paiements → redirection normale
         */
        return redirect()->route('checkout.success', $order->id);
    }


    /**
     * -----------------------------------------------------------
     *PAIEMENT WAVE
     * -----------------------------------------------------------
     */
    public function payConfirm(Orders $order)
    {
        $merchantNumber = '+2250143633011';
        $amount = number_format($order->total, 0, '', '');
        $orderNumber = $order->order_number;

        //  Mobile → ouverture app Wave
        if ($this->isMobile()) {
            return redirect("wave://pay?recipient=$merchantNumber&amount=$amount&order=$orderNumber");
        }

        // Desktop → QR Code
        $qrData = json_encode([
            'recipient' => $merchantNumber,
            'amount'    => $amount,
            'order'     => $orderNumber
        ]);

        return view('payments.wave', compact('order', 'qrData'));
    }


    /**
     * -----------------------------------------------------------
     * CONFORMATION DU PAIEMENT (WAVE)
     * -----------------------------------------------------------
     */
    public function success(Orders $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status'         => 'completed'
        ]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Paiement Wave confirmé !');
    }


    /**
     * -----------------------------------------------------------
     * CALLBACK API (Wave → Votre Serveur)
     * -----------------------------------------------------------
     */
    public function paymentCallback(Request $request)
    {
        $orderId = $request->order_id;
        $status  = $request->status;

        $order = Orders::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Commande introuvable.'], 404);
        }

        $order->update([
            'payment_status' => $status === 'paid' ? 'paid' : 'failed',
            'status'         => $status === 'paid' ? 'completed' : 'failed',
        ]);

        return response()->json(['success' => true]);
    }


    /**
     * -----------------------------------------------------------
     * MTN MONEY & ORANGE MONEY
     * -----------------------------------------------------------
     */
    public function payWithMTN($orderId)
    {
        return view('payments.mtn', compact('orderId'));
    }

    public function payWithOrange($orderId)
    {
        return view('payments.orange', compact('orderId'));
    }


    /**
     * -----------------------------------------------------------
     * API WAVE → Création Transaction
     * -----------------------------------------------------------
     */
    public function createWavePayment(Request $request)
    {
        $client = new Client();
        $url = 'https://api.wave.com/v1/transactions';

        try {
            $response = $client->post($url, [
                'json' => [
                    'amount'       => $request->amount,
                    'currency'     => 'CFA',
                    'phone'        => $request->phone,
                    'order_id'     => $request->order_id,
                    'callback_url' => route('payment.callback'),
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('WAVE_API_KEY'),
                ]
            ]);

            $data = json_decode($response->getBody());

            return response()->json([
                'payment_url' => $data->payment_url ?? null,
                'order_id'    => $request->order_id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur API Wave: ' . $e->getMessage()], 500);
        }
    }


    /**
     * -----------------------------------------------------------
     * MÉTHODE UTILE
     * -----------------------------------------------------------
     */
    private function isMobile()
    {
        return preg_match('/android|iphone|ipad|mobile/i', request()->header('User-Agent'));
    }
}
