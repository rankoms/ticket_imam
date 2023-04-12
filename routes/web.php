<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedeemVoucherController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkin', [RedeemVoucherController::class, 'checkin'])->name('checkin');
    Route::get('/checkin_v2', [RedeemVoucherController::class, 'checkin_v2'])->name('checkin_v2');
    Route::get('/checkout', [RedeemVoucherController::class, 'checkout'])->name('checkout');

    Route::post('/barcode_checkin', [HomeController::class, 'barcode_checkin'])->name('barcode_checkin');
    Route::post('/barcode_checkout', [HomeController::class, 'barcode_checkout'])->name('barcode_checkout');

    Route::get('/dashboard_ticket', [TicketController::class, 'dashboard_ticket'])->name('dashboard_ticket');
    Route::post('/cek_redeem_vouceher', [RedeemVoucherController::class, 'cek_redeem_voucher'])->name('redeem_voucher.cek_redeem_voucher');
    Route::post('/redeem_voucher_update', [RedeemVoucherController::class, 'redeem_voucher_update'])->name('redeem_voucher.redeem_voucher_update');
});

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('user_logout', [LoginController::class, 'logout'])->name('user.logout');
Auth::routes();
