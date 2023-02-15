<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedeemVoucherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/checkin', [RedeemVoucherController::class, 'checkin'])->name('checkin');
Route::get('/checkout', [RedeemVoucherController::class, 'checkout'])->name('checkout');

Route::post('/barcode_checkin', [HomeController::class, 'barcode_checkin'])->name('barcode_checkin');
Route::post('/barcode_checkout', [HomeController::class, 'barcode_checkout'])->name('barcode_checkout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
