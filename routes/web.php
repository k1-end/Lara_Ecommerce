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
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/product/{product}' , [ProductController::class , 'show'])->name('product');
Route::get('/add_to_cart/{product}' , [ProductController::class , 'add_to_cart'])->name('add_to_cart')->middleware('auth');
Route::get('cart', [ProductController::class , 'cart_page'])->name('cart');


Route::get('/order' , [OrderController::class , 'order_page'])->name('order');
Route::get('/checkout', [OrderController::class, 'checkout']);

Route::get('/dummy_payment' , [OrderController::class , 'dummy_payment'])->name('dummy_payment');
Route::get('/successful_payment' , [OrderController::class , 'successful_payment'])->name('successful_payment');
Route::post('/callback', [OrderController::class, 'callback'])->name('callback');

Route::get('/dashboard/products/new' , [ProductController::class , 'create'])->middleware(App\Http\Middleware\OnlyAdmin::class)->name('new_product');
Route::post('/dashboard/products/new' , [ProductController::class , 'store'])->middleware(App\Http\Middleware\OnlyAdmin::class);
Route::get('/dashboard/products' , [ProductController::class , 'index'])->middleware(App\Http\Middleware\OnlyAdmin::class);
Route::get('/dashboard/products/{product}' , [ProductController::class , 'show'])->middleware(App\Http\Middleware\OnlyAdmin::class);
Route::get('/dashboard/products/edit/{product}' , [ProductController::class , 'edit'])->middleware(App\Http\Middleware\OnlyAdmin::class)->name('edit_product');
Route::get('/dashboard/products/delete/{product}' , [ProductController::class , 'destroy'])->middleware(App\Http\Middleware\OnlyAdmin::class)->name('delete_product');
Route::post('/product/edit/{product}' , [ProductController::class , 'update'])->middleware(App\Http\Middleware\OnlyAdmin::class);



Route::get('/dashboard' , [DashboardController::class , 'index'])->middleware(App\Http\Middleware\OnlyAdmin::class);
Route::get('/dashboard/users' , [UserController::class , 'index'])->middleware(App\Http\Middleware\OnlyAdmin::class);
Route::get('/dashboard/{user}' , [UserController::class , 'show'])->middleware(App\Http\Middleware\OnlyAdmin::class);


Route::get('search/' , [ProductController::class , 'search'])->name('search');


