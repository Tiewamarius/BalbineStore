<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Génère une "graine" (seed) qui change toutes les 30 minutes
        $now = Carbon::now();
        $interval = floor($now->minute / 30); // 0 pour 00-29 min, 1 pour 30-59 min
        $seed = $now->format('YmdH') . $interval; // Exemple : 2025102910_0

        // 1. Récupération des catégories avec leur image principale
        $categories = Categories::with(['products.images' => function ($q) {
            $q->where('is_main', true);
        }])->get();

        // 2. Sélection stable et aléatoire de 4 produits (même pendant 30min)
        // On mélange avec un "seed" pour avoir une pseudo-randomisation stable
        srand(crc32($seed));

        $products = Products::with(['images' => function ($q) {
            $q->where('is_main', true);
        }])->get()
            ->shuffle()
            ->take(4);

        srand(); // réinitialise le générateur pour éviter d’impacter ailleurs

        // 3. Envoi à la vue
        return view('welcome', compact('categories', 'products'));
    }
}
