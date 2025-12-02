<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\carts;
use App\Models\cartitems;
use App\Models\products;

class CartController extends Controller
{
    /**
     * Afficher le panier
     */

    // Augmenter quantité pour session
    public function increaseSession(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            $quantity = $cart[$id]['quantity'];
            $count = array_sum(array_column($cart, 'quantity'));

            return response()->json(['quantity' => $quantity, 'cart_total' => $count]);
        }

        return response()->json(['quantity' => 0, 'cart_total' => 0]);
    }

    // Diminuer quantité pour session
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
            $count = array_sum(array_column($cart, 'quantity'));

            return response()->json(['quantity' => $quantity, 'cart_total' => $count]);
        }

        return response()->json(['quantity' => 0, 'cart_total' => 0]);
    }

    public function index()
    {
        if (Auth::check()) {
            // Panier actif de l’utilisateur
            $cart = carts::with('items.product')
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->first();

            // Si pas de panier existant → créer
            if (!$cart) {
                $cart = carts::create([
                    'user_id' => Auth::id(),
                    'status' => 'active',
                ]);
            }
        } else {
            // Panier stocké en session
            $cart = session('cart', []);
        }

        return view('cart.index', compact('cart'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request, $id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            // Panier actif ou création
            $cart = carts::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active',
            ]);

            // Vérifie si le produit existe déjà
            $item = cartitems::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($item) {
                $item->increment('quantity');
            } else {
                cartitems::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'unit_price' => $product->price,
                ]);
            }

            $count = $cart->items()->sum('quantity');
        } else {
            // Utilisateur non connecté → panier en session
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image,
                ];
            }

            session()->put('cart', $cart);
            $count = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json(['success' => true, 'count' => $count]);
    }

    /**
     * Mettre à jour la quantité d’un article
     */
    public function update(Request $request, $id)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $product = products::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            $cart = carts::where('user_id', Auth::id())
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
     * Supprimer un article
     */
    public function remove($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if (Auth::check()) {
            $cart = carts::where('user_id', Auth::id())->where('status', 'active')->first();

            if ($cart) {
                $cart->items()->where('product_id', $product->id)->delete();
            }

            $count = $cart ? $cart->items()->sum('quantity') : 0;
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            $count = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json(['success' => true, 'count' => $count]);
    }

    /**
     * Vider complètement le panier
     */
    public function clear()
    {
        if (Auth::check()) {
            carts::where('user_id', Auth::id())
                ->where('status', 'active')
                ->delete();
        } else {
            session()->forget('cart');
        }

        return response()->json(['success' => true, 'count' => 0]);
    }


    public function increase(Request $request)
    {
        $item = cartitems::where('cart_id', auth()->user()->activeCart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        }

        return response()->json([
            'quantity' => $item->quantity,
            'cart_total' => auth()->user()->activeCart->items->sum('quantity'),
        ]);
    }

    public function decrease(Request $request)
    {
        $item = cartitems::where('cart_id', auth()->user()->activeCart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item && $item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }

        return response()->json([
            'quantity' => $item->quantity,
            'cart_total' => auth()->user()->activeCart->items->sum('quantity'),
        ]);
    }
}
