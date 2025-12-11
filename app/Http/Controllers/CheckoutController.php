<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Addresses;

class CheckoutController extends Controller
{
    /**
     * ------------------------------
     *  AFFICHAGE DE LA PAGE CHECKOUT
     * ------------------------------
     */
    public function index()
    {
        // Récupération du panier actif
        $cart = Carts::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        // Vérification du panier
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('compte')->with('error', 'Votre panier est vide.');
        }

        // Vérification de l'adresse de livraison
        $address = auth()->user()->addresses()->where('type', 'livraison')->first();

        if (!$address) {
            session()->put('new_address', true); // signal pour afficher un formulaire d’adresse
        }

        return view('checkout', compact('cart', 'address'));
    }



    /**
     * ------------------------------
     *   CREATION DE LA COMMANDE
     * ------------------------------
     */
    public function store(Request $request)
    {
        // 1) Validation
        $validated = $request->validate([
            'fullname'        => 'required|string|max:255',
            'phone'           => 'required|string|max:20',
            'address_id'      => 'nullable|exists:addresses,id',

            // Si pas d'adresse existante, alors adresse obligatoire :
            'delivery_address' => 'required_without:address_id|string|max:255',
            'city'            => 'required_without:address_id|string|max:100',
            'postal_code'     => 'nullable|string|max:20',
            'country'         => 'required_without:address_id|string|max:100',

            'payment_method'  => 'required|in:mtn,orange,wave',
        ]);


        // 2) Récupération du panier
        $cart = Carts::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            return back()->with('error', 'Panier introuvable.');
        }


        // 3) Récupération ou création d’adresse
        if (empty($validated['address_id'])) {
            // → Création d’une nouvelle adresse
            $address = Addresses::create([
                'user_id'     => auth()->id(),
                'type'        => 'livraison',
                'street'      => $validated['delivery_address'],
                'city'        => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'country'     => $validated['country'],
                'phone'       => $validated['phone'],
            ]);
        } else {
            // → Utiliser l’adresse existante
            $address = Addresses::find($validated['address_id']);
            if (!$address) {
                return back()->with('error', 'Adresse non trouvée.');
            }
        }


        // 4) Calculs des montants
        $subtotal = $cart->items->sum(
            fn($item) =>
            $item->quantity * $item->unit_price
        );

        $shippingFee = 1000; // Frais fixes
        $total = $subtotal + $shippingFee;


        // 5) Création de la commande
        try {
            $order = Orders::create([
                'user_id'        => auth()->id(),
                'address_id'     => $address->id,
                'order_number'   => Orders::generateOrderNumber(),
                'subtotal'       => $subtotal,
                'shipping_fee'   => $shippingFee,
                'total'          => $total,
                'status'         => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
            ]);

            // 6) Ajout des items
            foreach ($cart->items as $item) {
                OrderItems::create([
                    'order_id'          => $order->id,
                    'product_id'        => $item->product->id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity'          => $item->quantity,
                    'unit_price'        => $item->unit_price,
                    'total_price'       => $item->quantity * $item->unit_price,
                ]);
            }

            // 7) Vider le panier
            $cart->items()->delete();
            $cart->update(['status' => 'completed']);

            // Réponse JSON pour redirection JS
            return response()->json(['order_id' => $order->id]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création de la commande : ' . $e->getMessage()
            ]);
        }
    }
}
