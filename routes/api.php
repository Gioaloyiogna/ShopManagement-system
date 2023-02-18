<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//products routes
Route::prefix('product')->group(function () {
    Route::get('/{shop_code}', [ProductController::class, 'index']);
    Route::post('/add', [ProductController::class, 'store']);
    Route::post('/updateProduct', [ProductController::class, 'updateProduct']);
});
//sales routes

Route::prefix('sales')->group(function () {
    Route::get('/{shop_code}', [SalesController::class, 'index']);
    Route::get('/searchItem/{data}', [SalesController::class, 'searchItem']);
    Route::post('/addProduct', [SalesController::class, 'addProduct']);
});
