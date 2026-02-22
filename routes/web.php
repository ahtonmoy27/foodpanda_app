<?php

use App\Http\Controllers\FoodpandaController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Foodpanda App (SSO Client)
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [FoodpandaController::class, 'home'])->name('home');
Route::get('/restaurants', [FoodpandaController::class, 'restaurants'])->name('restaurants');

// SSO routes
Route::get('/login', [SsoController::class, 'login'])->name('login');
Route::get('/sso/callback', [SsoController::class, 'callback'])->name('sso.callback');
Route::post('/logout', [SsoController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware('sso.auth')->group(function () {
    Route::get('/dashboard', [FoodpandaController::class, 'dashboard'])->name('dashboard');
    Route::get('/menu/{restaurant}', [FoodpandaController::class, 'menu'])->name('menu');
    Route::get('/orders', [FoodpandaController::class, 'orders'])->name('orders');
    Route::post('/order/add', [FoodpandaController::class, 'addToOrder'])->name('order.add');
});
