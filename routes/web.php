<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::get('/', [ProductController::class,'index']);
Route::view('/about', 'about')->name('about');
Route::get('/history', [CheckoutController::class, 'history']);
Route::post('/history/delete/{id}', [CheckoutController::class, 'destroy']);
Route::post('/history/delete-all', [CheckoutController::class, 'destroyAll']);
Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
Route::get('/checkout/{id}/invoice', [CheckoutController::class, 'invoice']);
Route::get('/cart', [CartController::class,'index']);
Route::post('/cart/add/{product}', [CartController::class, 'add']);
Route::post('/checkout', [CheckoutController::class,'checkout']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']); 

