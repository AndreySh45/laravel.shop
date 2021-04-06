<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'] );
Route::get('/catedory/{cat}/{product_id}', [ProductController::class, 'show'] )->name('showProduct');
Route::get('/catedory/{cat}', [ProductController::class, 'showCategory'] )->name('showCategory');
Route::get('/cart', [CartController::class, 'index'] )->name('cartIndex');

Route::post('/add-to-cart', [CartController::class, 'addToCart'] )->name('addToCart');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'user'])->name('home');
Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('homeAdmin'); // /admin
});
