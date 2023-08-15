<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SharingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function($router){
    // anggota
    Route::post('/anggota', [AnggotaController::class, 'store']); 
    // Route::get('anggota/{anggota}', [AnggotaController::class, 'show']);
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update']);
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy']);

    // angkatan
    Route::post('/angkatan', [AngkatanController::class, 'store']); 
    Route::delete('/angkatan/{angkatan}', [AngkatanController::class, 'destroy']);

    // kategori 
    Route::post('/kategori', [KategoriController::class, 'store']); 
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy']);

    // acara 
    Route::post('/acara', [AcaraController::class, 'store']); 
    // Route::get('/acara/{acara}', [AcaraController::class, 'show']);
    Route::put('/acara/{acara}', [AcaraController::class, 'update']);
    Route::delete('/acara/{acara}', [AcaraController::class, 'destroy']);

    // artikel
    Route::post('/artikel', [ArtikelController::class, 'store']); 
    // Route::get('/artikel/{artikel}', [ArtikelController::class, 'show']);
    Route::put('/artikel/{artikel}', [ArtikelController::class, 'update']);
    Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy']);

    // sharing
    Route::post('/sharing', [SharingController::class, 'store']); 
    // Route::get('/sharing/{sharing}', [SharingController::class, 'show']);
    Route::put('/sharing/{sharing}', [SharingController::class, 'update']);
    Route::delete('/sharing/{sharing}', [SharingController::class, 'destroy']);


    Route::post('/logout', [UserController::class, 'logout']); 
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// get
Route::get('/anggota', [AnggotaController::class, 'index']); 
Route::get('/angkatan', [AngkatanController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/acara', [AcaraController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/sharing', [SharingController::class, 'index']); 

// user
Route::post('/login', [UserController::class, 'authenticate']); 
Route::post('/register', [UserController::class, 'store']);