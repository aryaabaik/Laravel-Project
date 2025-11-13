<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'project', 'middleware' => 'auth'], function () {
    Route::resource('kategori', App\Http\Controllers\KategoriBukuController::class);
    Route::resource('pengarang', App\Http\Controllers\PengarangController::class);
    Route::resource('buku', App\Http\Controllers\BukuController::class);
})->middleware('auth');
