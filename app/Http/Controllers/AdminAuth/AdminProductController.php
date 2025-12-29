<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function allProducts()
    {
        //On récupère tous les produits
        $products = products::all();

        // On les envoie à la vue
        return view('admin.pages.allProducts', [
            'products' => $products
        ]);
    }
}
