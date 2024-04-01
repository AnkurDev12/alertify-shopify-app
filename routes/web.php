<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertifyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['verify.shopify'])->group(function () {
    Route::get('/', [AlertifyController::class,'welcome'])->name('home');
});
Route::get('/dashboard', [AlertifyController::class,'welcome'])->name('dashboard');
Route::get('products', [AlertifyController::class,'index'])->name('products.index');
Route::post('/products/description', [AlertifyController::class,'store'])->name('products.store');
Route::get('/products/{product_id}/description', [AlertifyController::class,'editDescription'])->name('products.description.form');