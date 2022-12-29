<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'index'])->name('login.dashboard');
// Route::post('/', [LoginController::class, 'login'])->name('login.run');
Route::get('/register', [RegisterController::class, 'index'])->name('register.dashboard');
Route::post('/register', [RegisterController::class, 'register'])->name('register.pelanggan');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('admin.dashboard');
});

Route::group(['prefix'=>'pelanggan', 'middleware'=>['isPelanggan','auth']], function(){
    Route::get('/index', [KategoriController::class, 'index'])->name('pelanggan.dashboard');
});



