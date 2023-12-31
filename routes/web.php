<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\RedirectPaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::view('/login', 'login')->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth:web')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');

        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::get('/payment/finish', [RedirectPaymentController::class, 'finish'])->name('payment.finish');
