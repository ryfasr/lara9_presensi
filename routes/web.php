<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'halLogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
Route::post('/simpanregistrasi', [LoginController::class, 'simpanreg'])->name('simpanregister');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });
Route::group(['middleware' => ['auth', 'ceklevel:admin,karyawan']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::group(['middleware' => ['auth', 'ceklevel:karyawan']], function () {
    Route::get('/presensi-masuk', [PresensiController::class, 'index'])->name('masuk');
    route::post('/simpan-masuk', [PresensiController::class, 'store'])->name('simpanmasuk');
});
