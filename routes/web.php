<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Routes publiques (accès libre)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/detailsProduct/{products}', [ProductController::class, 'show'])
    ->name('product.show');

Route::get('/search', function () {
    return view('search');
})->name('search');

/*
|--------------------------------------------------------------------------
| Routes Panier (accessibles sans connexion)
|--------------------------------------------------------------------------
| Utilise la session pour stocker les produits.
| Permet aux visiteurs d’ajouter au panier sans compte.
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/cart/count', function () {
    if (auth()->check()) {
        $cart = \App\Models\Carts::where('user_id', auth()->id())->where('status', 'active')->first();
        $count = $cart ? $cart->items()->sum('quantity') : 0;
    } else {
        $cart = session('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
    }
    return response()->json(['count' => $count]);
});

/*
|--------------------------------------------------------------------------
| Routes Authentifiées
|--------------------------------------------------------------------------
| Nécessitent que l’utilisateur soit connecté.
*/

Route::middleware('auth')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Compte & profil
    Route::get('/compte', [ProfileController::class, 'compte'])->name('compte');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentification Laravel Breeze / Jetstream / Fortify
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Fallback (page non trouvée)
|--------------------------------------------------------------------------
| Redirige vers la page d’accueil si l’URL n’existe pas.
*/

Route::fallback(function () {
    return redirect('/');
});
