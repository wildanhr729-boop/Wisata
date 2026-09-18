<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;

Route::get('/', function () {
    return redirect('/wisata');
});

Route::get('/wisata', [WisataController::class, 'index']);
Route::get('/wisata/tambah', [WisataController::class, 'tambah']);
Route::post('/wisata/store', [WisataController::class, 'store']);

// Route ulasan harus di luar function
Route::post('/ulasan/store', [WisataController::class, 'storeUlasan']);