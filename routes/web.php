<?php

use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[RouteController::class,'dashboard'])->name('dashboard');

//logging out users
Route::get('/logout', function () {
    Auth::logout();
    return redirect("/login");
});

Route::get('/products', [RouteController::class, 'product'])->name('product');
Route::get('/sales', [RouteController::class, 'sale'])->name('sale');
require __DIR__ . '/auth.php';
