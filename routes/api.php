<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SkusController;
use App\Http\Controllers\Api\V1\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:api'])->group(function () {
    Route::get('skus', [SkusController::class, 'getSkus']);
});


Route::apiResources([
    'desks' => DeskController::class,
    'desk-lists' => DeskListController::class,
    'cards' => CardController::class,
    'tasks' => TaskController::class
]);

Route::post('/message', [ChatController::class, 'index']);
