<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use App\Models\Carts;
use App\Models\CartItems;

class MergeSessionCart
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        // Récupérer l'utilisateur
        $user = $event->user;

        // Récupérer le panier de la session
        $sessionCart = session('cart', []);

        // Si le panier session est vide, rien à faire
        if (empty($sessionCart)) {
            return;
        }

        // Récupérer ou créer un panier actif pour cet utilisateur
        $cart = Carts::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active']
        );

        // Fusionner les produits du panier de session dans la DB
        foreach ($sessionCart as $productId => $item) {
            // Vérifier si cet item est déjà dans la DB
            $cartItem = CartItems::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                // Si l'item existe déjà, on incrémente la quantité
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                // Sinon, on crée un nouvel item dans le panier DB
                CartItems::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'], // Assurez-vous que l'élément 'price' est présent dans $item
                ]);
            }
        }

        // Supprimer le panier de la session
        session()->forget('cart');
    }
}
