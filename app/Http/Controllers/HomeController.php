<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\carts;
use App\Models\products;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Génération du seed 30 min
        $now = Carbon::now();
        $interval = floor($now->minute / 30);
        $seed = $now->format('YmdH') . $interval;

        // Récupération des catégories essentielles (id, name, slug)
        $categories = categories::select('id', 'name', 'slug')->get();

        // == 1) Produits aléatoires globaux (5 produits) avec seed ==
        srand(crc32($seed));

        $randomProducts = products::with(['images' => function ($q) {
            $q->where('is_main', true);
        }])
            ->inRandomOrder()     // utilise le seed
            ->take(6)
            ->get();

        srand(); // reset

        // == 2) Produits par catégorie ==
        $productsByCategory = [];

        foreach ($categories as $category) {
            $productsByCategory[$category->slug] = products::with(['images' => function ($q) {
                $q->where('is_main', true);
            }])
                ->where('categories_id', $category->id)
                ->inRandomOrder()
                ->take(6)
                ->get();
        }

        return view('welcome', compact('categories', 'randomProducts', 'productsByCategory'));
    }
}
