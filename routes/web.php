<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WavePaymentController;

/*
|--------------------------------------------------------------------------
| Routes publiques (accès libre)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/detailsProduct/{products}', [ProductController::class, 'show'])
    ->name('product.show');

// La vue 'search' doit probablement être dans un contrôleur, mais on la laisse pour l'instant
Route::get('/search', function () {
    return view('search');
})->name('search');

/*
|--------------------------------------------------------------------------
| Routes Panier (accessibles sans connexion)
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// 💡 Amélioration: La logique de comptage devrait être dans le contrôleur ou un petit groupe de route
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
| Routes Authentifiées (auth & verified)
|--------------------------------------------------------------------------
| Les middlewares 'auth' et 'verified' sont appliqués à l'ensemble du groupe.
*/

// CORRECTION: Suppression de l'espace en trop avant 'verified'
Route::middleware(['auth', 'verified'])->group(function () {

    // Tableau de bord
    // SUPPRESSION: Le middleware 'verified' est déjà appliqué par le groupe.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Compte & profil
    // SUPPRESSION: Le middleware 'auth' est déjà appliqué par le groupe.
    Route::get('/compte', [ProfileController::class, 'compte'])
        ->name('compte');

    // Routes de ressources pour le profil (patch, delete, edit)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mettre ces routes POST dans un groupe si elles sont liées au panier/commandes
    Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Paiement Wave
    Route::get('/wave/pay/{order}', [WavePaymentController::class, 'pay'])->name('wave.pay');
    Route::get('/wave/success/{order}', [WavePaymentController::class, 'success'])->name('wave.success');
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
*/

Route::fallback(function () {
    return redirect('/');
});
