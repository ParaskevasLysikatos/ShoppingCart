<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);

Route::post('/detailProductAmount ', [App\Http\Controllers\HomeController::class, 'detailProductAmount']);

Route::post('/finalPayment', [App\Http\Controllers\HomeController::class, 'finalPayment']);

Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkout']);

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout']);

Route::post('/login', [App\Http\Controllers\HomeController::class, 'login']);

Route::get('/history', [App\Http\Controllers\HistoryController::class, 'history']);

Route::get('/discount_codes', [App\Http\Controllers\HistoryController::class, 'discount_codes']);
