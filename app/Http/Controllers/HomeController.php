<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class HomeController extends Controller
{
    public function index()
    {
        // On veut que le même mélange soit affiché pendant 24h
        $seed = date('Ymd'); // change chaque jour
        $categories = Categories::with(['products.images' => fn($q) => $q->where('is_main', true)])
            ->inRandomOrder($seed)
            ->take(8)
            ->get();

        return view('welcome', compact('categories'));
    }
}
