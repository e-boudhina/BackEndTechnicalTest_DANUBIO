<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::group(['prefix'=>'','middleware'=>['auth']], function() {

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/flow/orders_to_csv', [OrderController::class, 'fetch'])->name('order.to-csv');
//    Route::get('orders_to_csv', [OrderController::class, 'export_to_csv'])->name('order.to-csv');
    Route::delete('/orders/deleteAll', [OrderController::class, 'deleteAll'])->name('order.delete-all');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/orders/{order}/view/items', [OrderController::class, 'show'])->name('order.show');

});

Route::get('/home', [HomeController::class, 'index'])->name('home');
