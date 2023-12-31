<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataPlanController;
use App\Http\Controllers\API\OperatorCardController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\TipController;
use App\Http\Controllers\API\TopUpController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\TransferController;
use App\Http\Controllers\API\TransferHistoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/webhook', [WebhookController::class, 'update'])->name('webhook.update');

Route::middleware(['jwt.verify'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/top-up', [TopUpController::class, 'store'])->name('top-up.store');

    Route::post('/transfer', [TransferController::class, 'store'])->name('transfer.store');

    Route::post('/data-plan', [DataPlanController::class, 'store'])->name('data-plan.store');

    Route::get('/operator-card', [OperatorCardController::class, 'index'])->name('operator-card.index');

    Route::get('/payment-method', [PaymentMethodController::class, 'index'])->name('payment-method.index');

    Route::get('/transfer-history', [TransferHistoryController::class, 'index'])->name('transfer-history.index');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');

    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{username}', [UserController::class, 'getUsersByUsername'])->name('user.getUsersByUsername');
    Route::put('/user/{user:username}', [UserController::class, 'update'])->name('user.update');

    Route::get('/wallet', [WalletController::class, 'show'])->name('wallet.show');
    Route::put('/wallet', [WalletController::class, 'update'])->name('wallet.update');

    Route::get('/tip', [TipController::class, 'index'])->name('wallet.index');
});
