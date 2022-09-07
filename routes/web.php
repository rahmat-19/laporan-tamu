<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserTamuController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserTamuController::class, 'index'])->name('masuk.tamu');
Route::get('/history-pengunjung', [UserTamuController::class, 'history'])->name('history.tamu');
Route::get('/history-pengunjung/export', [UserTamuController::class, 'exportExcel'])->name('historyExport.tamu');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/keluar-tamu/{userTamu}', [UserTamuController::class, 'outGuest'])->name('outGuest.tamu');

Route::get('/tambah-tamu', [UserTamuController::class, 'create'])->name('create.tamu');
Route::post('/tambah-tamu', [UserTamuController::class, 'store'])->name('store.tamu');
