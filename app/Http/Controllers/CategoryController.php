<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Categories($id)
    {
        // Récupère la catégorie par ID avec ses produits et leurs variantes
        $category = categories::with([
            'products.variants.images',
            'products.images',
        ])->findOrFail($id);

        $products = $category->products ?? collect([]);

        return view('categories', compact('category', 'products'));
    }
}
