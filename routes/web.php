<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
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

    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
    Route::get('/kategori/get-data', [KategoriController::class, 'getData'])->name('admin.kategori.getdata');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori/create', [KategoriController::class, 'store'])->name('admin.kategori.create');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('/kategori/edit/{id}', [KategoriController::class, 'update'])->name('admin.kategori.edit');
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.supplier');
    Route::get('/supplier/get-data', [SupplierController::class, 'getData'])->name('admin.supplier.getdata');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('admin.supplier.create');
    Route::post('/supplier/create', [SupplierController::class, 'store'])->name('admin.supplier.create');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
    Route::post('/supplier/edit/{id}', [SupplierController::class, 'update'])->name('admin.supplier.edit');
    Route::get('/supplier/delete/{id}', [SupplierController::class, 'destroy'])->name('admin.supplier.delete');


});

Route::group(['prefix'=>'pelanggan', 'middleware'=>['isPelanggan','auth']], function(){
    Route::get('/home', [ObatController::class, 'indexPelanggan'])->name('pelanggan.dashboard');
});



