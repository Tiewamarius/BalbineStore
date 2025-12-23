<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\carts;
use App\Models\cartitems;
use App\Models\Products;

class CartController extends Controller
{
    /**
     * Afficher le panier
     */
    public function index()
    {
        if (Auth::check()) {
            $cart = Carts::with('items.product')
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->first();

            if (!$cart) {
                // Crée un panier actif si aucun n'existe pour l'utilisateur
                $cart = Carts::create([
                    'user_id' => Auth::id(),
                    'status' => 'active',
                ]);
            }
        } else {
            // Récupère le panier depuis la session pour les utilisateurs non connectés
            $cart = session('cart', []);
        }

        return view('cart.index', compact('cart'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            // Gestion du panier pour utilisateur connecté
            $cart = Carts::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active',
            ]);

            $item = CartItems::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($item) {
                // Incrémentation de la quantité
                $item->increment('quantity');
            } else {
                // Ajout d'un nouvel article
                CartItems::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'unit_price' => $product->price,
                ]);
            }

            // Mise à jour du nombre d'articles
            $count = $cart->items()->sum('quantity');
        } else {
            // Gestion du panier pour utilisateur non connecté (session)
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                // Mise à jour de la quantité si le produit existe
                $cart[$product->id]['quantity']++;
            } else {
                // Ajout du produit au panier si ce n'est pas encore fait
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->images->first()?->image_path ?? 'images/no-image.png',
                ];
            }

            // Mise à jour de la session
            session()->put('cart', $cart);
            $count = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json(['success' => true, 'count' => $count]);
    }


    /**
     * Mettre à jour la quantité d'un article dans le panier
     */
    public function update(Request $request, $id)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            $cart = Carts::where('user_id', Auth::id())
                ->where('status', 'active')
                ->first();

            if ($cart) {
                $item = $cart->items()->where('product_id', $product->id)->first();
                if ($item) {
                    $item->update(['quantity' => $qty]);
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] = $qty;
                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Supprimer un article du panier
     */
    public function remove(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            $cart = Carts::where('user_id', Auth::id())->where('status', 'active')->first();
            if ($cart) {
                $cart->items()->where('product_id', $product->id)->delete();
                $count = $cart->items()->sum('quantity');
            } else {
                $count = 0;
            }
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            $count = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json(['success' => true, 'count' => $count]);
    }

    /**
     * Vider le panier
     */
    public function clear()
    {
        if (Auth::check()) {
            $cart = Carts::where('user_id', Auth::id())->where('status', 'active')->first();
            if ($cart) {
                $cart->items()->delete();
            }
        } else {
            session()->forget('cart');
        }

        return response()->json(['success' => true, 'count' => 0]);
    }


    // Augmenter la quantité d'un article (connecté)
    public function increase(Request $request)
    {
        $cart = Carts::where('user_id', auth()->id())->where('status', 'active')->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Panier introuvable', 'quantity' => 0, 'cart_total' => 0]);
        }

        $item = CartItems::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Article non trouvé', 'quantity' => 0, 'cart_total' => $cart->items()->sum('quantity')]);
        }

        $item->increment('quantity');

        $cart_total = $cart->items()->sum('quantity');

        return response()->json(['success' => true, 'quantity' => $item->quantity, 'cart_total' => $cart_total]);
    }

    // Diminuer la quantité d'un article (connecté)
    public function decrease(Request $request)
    {
        $cart = Carts::where('user_id', auth()->id())->where('status', 'active')->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Panier introuvable', 'quantity' => 0, 'cart_total' => 0]);
        }

        $item = CartItems::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Article non trouvé', 'quantity' => 0, 'cart_total' => $cart->items()->sum('quantity')]);
        }

        if ($item->quantity > 1) {
            $item->decrement('quantity');
            $quantity = $item->quantity;
        } else {
            // store the quantity BEFORE deletion so we can return it
            $quantity = 0;
            $item->delete();
        }

        $cart_total = $cart->items()->sum('quantity');

        return response()->json(['success' => true, 'quantity' => $quantity, 'cart_total' => $cart_total]);
    }


    /**
     * Augmenter la quantité d'un article (non connecté)
     */
    public function increaseSession(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        $count = array_sum(array_column($cart, 'quantity'));
        $quantity = $cart[$id]['quantity'] ?? 0;

        return response()->json(['quantity' => $quantity, 'cart_total' => $count]);
    }

    /**
     * Diminuer la quantité d'un article (non connecté)
     */
    public function decreaseSession(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                $quantity = $cart[$id]['quantity'];
            } else {
                unset($cart[$id]);
                $quantity = 0;
            }
            session()->put('cart', $cart);
        } else {
            $quantity = 0;
        }

        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['quantity' => $quantity, 'cart_total' => $count]);
    }

    /**
     * Charger le contenu de la sidebar panier
     */
    public function loadSidebar()
    {
        if (!auth()->check()) {
            $cart = session('cart', []);
            return view('partials.cart-sidebar-items', compact('cart'))->render();
        }

        $cart = Carts::with('items.product')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        return view('partials.cart-sidebar-items', compact('cart'))->render();
    }
}
