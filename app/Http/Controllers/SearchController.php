<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Affiche la page de recherche
     */
    public function searchPage(Request $request)
    {
        $randomProducts = products::with('images')
            ->inRandomOrder()
            ->limit(8) // → 8 produits = 2 lignes × 4 colonnes
            ->get();

        return view('search', compact('randomProducts'));
    }

    /**
     * API Ajax pour rechercher les produits
     */
    public function search_products(Request $request)
    {
        $q = $request->query('q');

        if (!$q || strlen($q) < 2) {
            return response()->json([]);
        }

        $products = products::with('images')
            ->where('name', 'LIKE', "%$q%")
            ->orWhere('description', 'LIKE', "%$q%")
            ->limit(20)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'price' => number_format($p->price, 0, ',', ' '),
                    'image' => $p->images->first()->image_path ?? 'images/default.png',
                ];
            });

        return response()->json($products);
    }
}
