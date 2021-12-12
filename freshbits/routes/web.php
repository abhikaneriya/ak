<?php

use App\Http\Controllers\logincontroller;
use App\Http\Controllers\productcontroller;
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

Route::view('register', 'register');
Route::post('register', [logincontroller::class, 'register']);
Route::view('login', 'login');
Route::post('login', [logincontroller::class, 'login']);
Route::get('logout', [logincontroller::class, 'logout']);
Route::view('forgotpass', 'forgotpassword.forgotpassword');
Route::post('forgotpass', [logincontroller::class, 'forgotpass']);

Route::middleware(['checkauth'])->group(function () {
    //
    Route::resource('product', productcontroller::class);
    Route::delete('myproductsDeleteAll', [productcontroller::class, 'deleteAll']);
});
