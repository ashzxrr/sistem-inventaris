<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang', [BarangController::class, 'store']);
Route::post('/barang/bulk-store', [BarangController::class, 'bulkStore']);
Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
Route::get('/mutasi', [MutasiController::class, 'index']);
Route::get('/mutasi/create', [MutasiController::class, 'create']);
Route::post('/mutasi', [MutasiController::class, 'store']);
Route::get('/mutasi/{id}/edit', [MutasiController::class, 'edit']);
Route::put('/mutasi/{id}', [MutasiController::class, 'update']);
Route::delete('/mutasi/{id}', [MutasiController::class, 'destroy']);