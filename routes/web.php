<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WavePaymentController;

/*
|--------------------------------------------------------------------------
| Routes publiques (accÃ¨s libre)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categorie/{id}', [CategoryController::class, 'Categories'])->name('category.categories');



Route::get('/detailsProduct/{products}', [ProductController::class, 'show'])
    ->name('product.show');

// La vue 'search' doit probablement Ãªtre dans un contrÃ´leur, mais on la laisse pour l'instant


Route::get('/search', [SearchController::class, 'searchPage']);

Route::get('/search-products', [SearchController::class, 'search_products']);
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

// ðŸ’¡ AmÃ©lioration: La logique de comptage devrait Ãªtre dans le contrÃ´leur ou un petit groupe de route
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
| Routes AuthentifiÃ©es (auth & verified)
|--------------------------------------------------------------------------
| Les middlewares 'auth' et 'verified' sont appliquÃ©s Ã  l'ensemble du groupe.
*/

// CORRECTION: Suppression de l'espace en trop avant 'verified'
Route::middleware(['auth', 'verified'])->group(function () {

    // Tableau de bord
    // SUPPRESSION: Le middleware 'verified' est dÃ©jÃ  appliquÃ© par le groupe.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Compte & profil
    // SUPPRESSION: Le middleware 'auth' est dÃ©jÃ  appliquÃ© par le groupe.
    Route::get('/compte', [ProfileController::class, 'compte'])
        ->name('compte');

    // Routes de ressources pour le profil (patch, delete, edit)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mettre ces routes POST dans un groupe si elles sont liÃ©es au panier/commandes
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
| Fallback (page non trouvÃ©e)
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect('/');
});
