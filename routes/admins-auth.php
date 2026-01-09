<?php

use App\Http\Controllers\AdminAuth\AdminAuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\AdminConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\AdminEmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\AdminEmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\AdminNewPasswordController;
use App\Http\Controllers\AdminAuth\AdminProfileController;
use App\Http\Controllers\AdminAuth\AdminController;
use App\Http\Controllers\AdminAuth\SalesController;
use App\Http\Controllers\AdminAuth\AdminPaymentsController;
use App\Http\Controllers\AdminAuth\NotificationsController;
use App\Http\Controllers\AdminAuth\AdminProductController;
use App\Http\Controllers\AdminAuth\AdminCustomersController;
use App\Http\Controllers\AdminAuth\AdminOrdersController;
use App\Http\Controllers\AdminAuth\AdminPasswordController;
use App\Http\Controllers\AdminAuth\AdminPasswordResetLinkController;
use App\Http\Controllers\AdminAuth\RegisteredAdminController;
use App\Http\Controllers\AdminAuth\AdminVerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);


    Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])
        ->name('admin.password.request');

    Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])
        ->name('admin.password.email');

    Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])
        ->name('admin.password.reset');

    Route::post('reset-password', [AdminNewPasswordController::class, 'store'])
        ->name('admin.password.store');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // profil
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password');


    // crud admin

    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');

    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');

    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');

    Route::patch('/admins/{admin}/toggle', [AdminController::class, 'toggleStatus'])
        ->name('admin.admins.toggle');

    Route::post('/admins/{admin}/reset-password', [AdminController::class, 'resetPassword'])
        ->name('admin.admins.reset-password');

    // Tableau de bord
    Route::get('dashboard', [AdminController::class, 'homes'])
        ->name('admin.dashboard');

    /**
     * Produits
     */
    // Route pour afficher la liste (celle que vous utilisez pour votre tableau)
    Route::get('all-products', [AdminProductController::class, 'SearchProducts'])
        ->name('admin.pages.allproducts');


    // Showproduct
    Route::get('showproducts', [AdminProductController::class, 'showProduct']);
    // Route pour afficher le formulaire de création

    Route::get('add-products', [AdminProductController::class, 'AddProducts'])
        ->name('admin.pages.Addproducts');

    // store product
    Route::post('/products/store', [AdminProductController::class, 'StoreProduct'])
        ->name('admin.products.storeProduct');

    // EditProduct
    Route::get('/products/{id}/editProduct', [AdminProductController::class, 'editProduct'])
        ->name('admin.products.editProduct');

    // UpdateProduct
    Route::put('/products/{id}', [AdminProductController::class, 'updateProduct'])
        ->name('admin.products.updateProduct');

    // DeleteProduct
    Route::delete('/admin/all-products/{id}', [AdminProductController::class, 'destroy'])
        ->name('admin.products.destroy');


    // Routes pour vos exports spécifiques (souvenez-vous de vos deux boutons)
    Route::get('/products/export-all', [AdminProductController::class, 'exportAll'])->name('products.export.all');
    Route::get('/products/export-delivery', [AdminProductController::class, 'exportForDelivery'])->name('products.export.delivery');



    // commandes
    Route::get('all-orders', [AdminOrdersController::class, 'SearchOrders'])
        ->name('admin.pages.allorders');

    // order client
    Route::get(
        '/admin/customers/{user}/orders',
        [AdminOrdersController::class, 'orders']
    )->name('admin.customers.orders');

    // Payment
    Route::get('/admin/payments', [AdminPaymentsController::class, 'index'])
        ->name('admin.pages.allpayments');



    // Clients
    Route::get('/admin/customers', [AdminCustomersController::class, 'index'])
        ->name('admin.pages.allcustomers');

    Route::get('/admin/customers/create', [AdminCustomersController::class, 'create'])
        ->name('admin.customers.create');

    Route::post('/admin/customers/store', [AdminCustomersController::class, 'store'])
        ->name('admin.customers.store');

    Route::get('/admin/customers/{user}/edit', [AdminCustomersController::class, 'edit'])
        ->name('admin.customers.edit');

    Route::put('/admin/customers/{user}', [AdminCustomersController::class, 'update'])
        ->name('admin.customers.update');

    Route::delete('/admin/customers/{user}', [AdminCustomersController::class, 'destroy'])
        ->name('admin.customers.destroy');

















    Route::get('/orders/{order}', [AdminOrdersController::class, 'show'])
        ->name('admin.orders-show');
    Route::patch('/admin/orders/{order}/status', [AdminOrdersController::class, 'updateStatus'])
        ->name('admin.orders.status');

    Route::get('orders/{orders}/edit', [AdminOrdersController::class, 'editResidence'])
        ->name('admin.orders.edit');

    // sales
    Route::get('/sales', [SalesController::class, 'Sales'])
        ->name('admin.pages.sales');


    // Notifications
    Route::get('/no-tification', [NotificationsController::class, 'Notification'])
        ->name('admin.pages.notification');




    /**
     * Paiements
     */

    /**
     * Utilisateurs (Admins)
     */
    Route::get('users', [AdminController::class, 'users'])
        ->name('admin.users.index');
    Route::get('users/create', [AdminController::class, 'createUser'])
        ->name('admin.users.create');
    Route::post('users', [AdminController::class, 'storeUser'])
        ->name('admin.users.store');
    Route::get('users/{user}/edit', [AdminController::class, 'editUser'])
        ->name('admin.users.edit');
    Route::put('users/{user}', [AdminController::class, 'updateUser'])
        ->name('admin.users.update');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])
        ->name('admin.users.destroy');

    /**
     * Rapports
     */
    Route::get('reports', [AdminController::class, 'reports'])
        ->name('admin.reports.index');
    Route::get('reports/{report}', [AdminController::class, 'showReport'])
        ->name('admin.reports.show');

    /**
     * Déconnexion
     */
    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});
