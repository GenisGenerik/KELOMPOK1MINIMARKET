<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth', 'role:jayusman']], function () {
    Route::get('/cabang', [CabangController::class,'index'])->name('cabang');
    Route::get('/cabang/create', [CabangController::class,'create'])->name('cabang.create');
    Route::post('/cabang', [CabangController::class,'store'])->name('cabang.store');
});
Route::group(['middleware' => ['auth', 'role:jayusman|manager']], function () {
    Route::get('/user', [UserController::class,'index'])->name('user');
    Route::get('/create', [UserController::class,'create'])->name('user.create');
    Route::post('/user', [UserController::class,'store'])->name('user.store');
    Route::get('/log/export', [LogController::class, 'export'])->name('log.export');
    Route::get('/produk/export', [ProdukController::class, 'export'])->name('produk.export');
    Route::get('/transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
});

Route::group(['middleware' => ['auth', 'role:kasir']], function () {
    Route::get('/transaksi/create', [TransaksiController::class,'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class,'store'])->name('transaksi.store');
});
Route::group(['middleware' => ['auth', 'role:jayusman|manager|supervisor|kasir']], function () {
    Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi');
    Route::get('/transaksi/{id}', [TransaksiController::class,'detail'])->name('transaksi.detail');
});



Route::group(['middleware' => ['auth', 'role:gudang|jayusman']], function () {

    Route::get('/produk/create', [ProdukController::class,'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class,'store'])->name('produk.store');

});
Route::group(['middleware' => ['auth', 'role:gudang|jayusman|manager']], function () {
    Route::get('/log', [LogController::class,'index'])->name('log');
    Route::get('/produk', [ProdukController::class,'index'])->name('produk');
});

Route::group(['middleware' => ['auth', 'role:gudang']], function () {
    Route::get('/log/create', [LogController::class,'create'])->name('log.create');
    Route::post('/log', [LogController::class,'store'])->name('log.store');
});

require __DIR__.'/auth.php';
