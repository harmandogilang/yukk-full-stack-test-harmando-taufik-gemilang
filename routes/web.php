<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\HomeController;
use App\Models\Transactions;

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

Route::controller(BankAccountController::class)->middleware('auth')->group(function(){
    Route::get('get', 'get')->name('bank_accounts.get');
});

Route::controller(Transactions::class)->middleware('auth')->group(function(){
    Route::post('transaction', 'do_transaction')->name('transaction.post');
    Route::get('history', 'history')->name('transaction.history');
    Route::post('approve', 'approve')->name('transaction.approve');
});

Route::controller(HomeController::class)->middleware('auth')->group(function(){
    Route::get('transaction-history', 'history')->name('history');
    Route::get('transaction', 'transaction')->name('transaction');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('auth.register');
    Route::post('register', 'do_register')->name('auth.do_register');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'do_login')->name('auth.do_login');
    Route::get('logout', 'logout')->name('logout');
});