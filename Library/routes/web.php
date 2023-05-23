<?php

use App\Http\Controllers\LendingController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('customers', CustomerController::class);
Route::resource('books', BookController::class);
Route::get('/lendings/index', [LendingController::class, 'index'])->name('lendings.index');
Route::post('/lendings/store',[LendingController::class, 'store'])->name('lendings.store');
Route::get('/lendings/update', [LendingController::class, 'update'])->name('lendings.update');