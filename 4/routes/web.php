<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/artikel', [App\Http\Controllers\ArtikelController::class, 'index'])->name('artikel.index')->middleware('is_admin');
Route::get('/artikel/create', [App\Http\Controllers\ArtikelController::class, 'create'])->name('artikel.create')->middleware('is_admin');
Route::post('/artikel', [App\Http\Controllers\ArtikelController::class, 'store'])->name('artikel.store')->middleware('is_admin');
Route::get('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'show'])->name('artikel.show')->middleware('is_admin');
Route::get('/artikel/{artikel}/edit', [App\Http\Controllers\ArtikelController::class, 'edit'])->name('artikel.edit')->middleware('is_admin');
Route::put('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'update'])->name('artikel.update')->middleware('is_admin');
Route::delete('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'destroy'])->name('artikel.destroy')->middleware('is_admin');