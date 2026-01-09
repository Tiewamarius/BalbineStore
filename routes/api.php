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
| SECTION API (Sanctum)
|--------------------------------------------------------------------------
*/

/*
|--------------------
| Routes publiques
|--------------------
*/

Route::post('/register', [RegisteredController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

/*
|--------------------
| Routes protégées
|--------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Utilisateur connecté
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});
 

/*
|--------------------------------------------------------------------------
| END SECTION API
|--------------------------------------------------------------------------
*/