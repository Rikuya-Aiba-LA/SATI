<?php

use App\Http\Controllers\LendingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('customers', CustomerController::class);
    Route::resource('books', BookController::class);
    Route::patch('books/trash/{book}', [BookController::class, 'trash'])->name('books.trash');
    Route::get('/lendings/index', [LendingController::class, 'index'])->name('lendings.index');

    Route::get('lendings/check/{customer}', [LendingController::class, 'check'])->name('lendings.check');
    Route::post('lendings/store', [LendingController::class, 'store'])->name('lendings.store');

    Route::post('/customers/unsub/{customer}',[CustomerController::class, 'unsub'])->name('customers.unsub');
    Route::post('/lendings/update/{lending}/{customer}',[lendingController::class, 'update'])->name('lendings.update');

});