<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart/get', [OrderController::class, 'getCart'])->name('order.get');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');

Route::get('/order/get', [OrderController::class, 'getOrder'])->name('order.get');

Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');

Route::post('/cart/delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::post('/order/received', [OrderController::class, 'received'])->name('order.received');