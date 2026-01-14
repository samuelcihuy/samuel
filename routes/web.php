<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::get('/', [ProductController::class,'index']);
Route::get('/cart', [CartController::class,'index']);
Route::post('/cart/add/{product}', [CartController::class, 'add']);
Route::post('/checkout', [CheckoutController::class,'checkout']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']); 

