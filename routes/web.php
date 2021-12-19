<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ProductController;

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
Auth::routes();
Route::get('/spa/{any}', [SpaController::class, 'index'])->where('any', '.*');
Route::get('locale/{locale}', [HomeController::class, 'changeLocale'])->name('locale');
Route::get('/reset', [ResetController::class, 'reset'])->name('reset');

Route::middleware(['set_locale'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('subscription/{product}', [ProductController::class, 'subscribe'])->name('subscription');
    Route::get('/catedory/{cat}/{product_id}', [ProductController::class, 'show'] )->name('showProduct');
    Route::get('/catedory/{cat}', [ProductController::class, 'showCategory'] )->name('showCategory');
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/add/{product}', [CartController::class, 'cartAdd'])->name('cartAdd');

        Route::group([
            'middleware' => 'cart_not_empty',
        ], function () {
            Route::get('/', [CartController::class, 'index'])->name('cartIndex');
            Route::get('/place', [CartController::class, 'cartPlace'])->name('cartPlace');
            Route::post('/remove/{product}', [CartController::class, 'cartRemove'])->name('cartRemove');
            Route::post('/place', [CartController::class, 'cartConfirm'])->name('cartConfirm');
        });
    });
    Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin_panel', 'middleware' => 'role:admin'], function () {
        Route::get('/', 'MainController@index')->name('homeAdmin'); // /admin
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('orders', 'OrderController');
    });
    Route::get('/home', [HomeController::class, 'user'])->name('home');
});
