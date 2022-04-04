<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
 

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
Route::get('/checkout', [OrderController::class, 'checkout']);

Route::get('/dummy_payment' , [OrderController::class , 'dummy_payment'])->name('dummy_payment');
Route::get('/successful_payment' , [OrderController::class , 'successful_payment'])->name('successful_payment');
Route::post('/callback', [OrderController::class, 'callback'])->name('callback');



Route::get('/dashboard' , [DashboardController::class , 'index'])->middleware(App\Http\Middleware\OnlyAdmin::class);


