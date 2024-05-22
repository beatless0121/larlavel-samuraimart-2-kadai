<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReviewController;

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

Route::get('/',  [WebController::class, 'index'])->name('top');

Route::controller(CartController::class)->group(function () {
    Route::get('users/carts', 'index')->name('carts.index');
    Route::post('users/carts', 'store')->name('carts.store');
    Route::delete('users/carts', 'destroy')->name('carts.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password'); 
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
});

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('products/{product}/favorite', [ProductController::class, 'favorite'])->name('products.favorite');

Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
