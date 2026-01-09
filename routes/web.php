<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\api\Auth\RegisteredController;
use App\Http\Controllers\api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categorie/{id}', [CategoryController::class, 'Categories'])->name('category.categories');
Route::get('/detailsProduct/{products}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [SearchController::class, 'searchPage']);
Route::get('/search-products', [SearchController::class, 'search_products']);

/*
|--------------------------------------------------------------------------
| Routes Panier (accessible sans connexion)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Compter le nombre d'articles dans le panier
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

Route::get('/cart/sidebar', [CartController::class, 'loadSidebar']);

// Routes session pour utilisateur non connecté
Route::post('/cart/session/increase', [CartController::class, 'increaseSession'])->name('cart.session.increase');
Route::post('/cart/session/decrease', [CartController::class, 'decreaseSession'])->name('cart.session.decrease');

/*
|--------------------------------------------------------------------------
| Routes Authentifiées (auth & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Profil / compte
    Route::get('/compte', [ProfileController::class, 'compte'])->name('compte');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Liste des commandes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Détail d'une commande
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Annuler une commande
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Repasser une commande (reorder)
    Route::get('/order/{order}/reorder', [OrderController::class, 'reorder'])->name('orders.reorder');

    // Panier connecté
    Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');

    // Checkout pour panier actif
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Checkout pour payer une commande existante
    Route::get('/checkout/order/{order}', [CheckoutController::class, 'payExistingOrder'])
        ->name('checkout.order');

    // Paiement Route
    Route::get('/payment/{order_id}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');

    // Paiement Wave
    Route::get('/wave/pay/{order}', [PaymentController::class, 'payConfirm'])->name('wave.pay');
    Route::get('/wave/success/{order}', [PaymentController::class, 'success'])->name('wave.success');

    // MTN
    Route::get('/mtn/pay/{order}', [PaymentController::class, 'payWithMTN'])->name('mtn.pay');

    // Orange
    Route::get('/orange/pay/{order}', [PaymentController::class, 'payWithOrange'])->name('orange.pay');
});




/*
|--------------------------------------------------------------------------
| Authentification Laravel Breeze / Jetstream / Fortify
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
require __DIR__ . '/admins-auth.php';

/*
|--------------------------------------------------------------------------
| Fallback (page non trouvé)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    if (auth()->guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }
    return redirect('/');
});
