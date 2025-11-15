<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/',function(){
        return view('admin.index');
    });
});

Route::group(['prefix' => 'project', 'middleware' => 'auth'], function () {
     Route::get('/peminjaman/search', [App\Http\Controllers\PeminjamanController::class, 'search'])->name('peminjaman.search');
    Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);
    Route::resource('kategori', App\Http\Controllers\KategoriBukuController::class);
    Route::resource('pengarang', App\Http\Controllers\PengarangController::class);
    Route::resource('buku', App\Http\Controllers\BukuController::class);
})->middleware('auth');

