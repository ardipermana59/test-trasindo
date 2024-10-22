<?php

use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminMenuTypeController;
use App\Http\Controllers\Admin\AdminMerchantController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Customer\CustomerCateringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Merchant\MerchantMenuController;
use App\Http\Controllers\Merchant\MerchantOrderController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'auth/login');

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('/users', AdminUserController::class)->names('users');
        Route::get('/customers', AdminCustomerController::class)->name('customers');
        Route::get('/merchants', AdminMerchantController::class)->name('merchants');
        Route::get('/menus', AdminMenuController::class)->name('menus');
        Route::get('/menus/types', AdminMenuTypeController::class)->name('types');
        Route::get('/orders', AdminOrderController::class)->name('orders');
    });

    Route::prefix('merchant')->middleware(['role:merchant'])->name('merchant.')->group(function () {
        //     // Menu Management
        Route::resource('menus', MerchantMenuController::class)->names('menus')->only(['index', 'store', 'destroy']);
        Route::post('menus/update', [MerchantMenuController::class, 'update'])->name('menus.update');
        Route::resource('orders', MerchantOrderController::class)->names('orders')->only(['index', 'update']);

        //     // Orders
        //     Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    });

    // // Rute untuk Portal Kantor (Customer)
    Route::prefix('customer')->name('customer.')->group(function () {

        //     // Catering Search
        Route::get('caterings', [CustomerCateringController::class, 'index'])->name('caterings.index');
        Route::post('caterings/order', [CustomerCateringController::class, 'order'])->name('caterings.order');

        //     Route::get('caterings/{id}', [CateringController::class, 'show'])->name('caterings.show');

        //     // Purchase
        //     Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

        //     // Invoices
        //     Route::get('invoices', [OrderController::class, 'invoices'])->name('invoices.index');
        //     Route::get('invoices/{id}', [OrderController::class, 'showInvoice'])->name('invoices.show');
    });
});

require base_path('routes/jetstream.php');
