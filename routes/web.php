<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ObatController;
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
    Route::get('/profile', [HomeController::class, 'index'])->name('admin.profile');

    Route::get('/home', [ObatController::class, 'index'])->name('admin.dashboard');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('admin.obat.create');
    Route::post('/obat/create', [ObatController::class, 'store'])->name('admin.obat.create');
    Route::get('/obat/edit/{id}', [ObatController::class, 'edit'])->name('admin.obat.edit');
    Route::post('/obat/edit/{id}', [ObatController::class, 'update'])->name('admin.obat.edit');
    Route::get('/obat/delete/{id}', [ObatController::class, 'destroy'])->name('admin.obat.delete');

});

Route::group(['prefix'=>'pelanggan', 'middleware'=>['isPelanggan','auth']], function(){
    Route::get('/home', [ObatController::class, 'indexPelanggan'])->name('pelanggan.dashboard');
});



