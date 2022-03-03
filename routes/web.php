<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class , 'index'])->name('home');
Route::get('/login', [UserController::class, 'login_page'])->middleware(App\Http\Middleware\LoginRedirect::class)->name('login');
Route::post('/login', [UserController::class, 'auth_user']);
Route::get('/signup', [UserController::class, 'signup_page'])->name('signup');
Route::post('/signup', [UserController::class, 'signup']);

Route::get('/product/{product}' , [ProductController::class , 'show'])->name('product');
Route::get('/add_to_cart/{product}' , [ProductController::class , 'add_to_cart'])->name('add_to_cart')->middleware('auth');
Route::get('cart', [ProductController::class , 'cart_page'])->name('cart');


Route::get('/order' , [OrderController::class , 'order_page'])->name('order');




