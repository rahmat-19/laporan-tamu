<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserInformatiaonController;
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
Route::get('/keluar-tamu/{userTamu}', [UserTamuController::class, 'outGuest'])->name('outGuest.tamu');

Route::get('/tambah-tamu', [UserTamuController::class, 'create'])->name('create.tamu');
Route::post('/tambah-tamu', [UserTamuController::class, 'store'])->name('store.tamu');



Route::middleware('guest')->group(function () {
    Route::get('/rahasia', [LoginController::class, 'index'])->name('login');
    Route::post('/rahasia/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('user-information', [UserInformatiaonController::class, 'index'])->name('userInformation.user');
    Route::get('history-pengunjung', [UserInformatiaonController::class, 'history'])->name('history.user');
    Route::get('history-pengunjung/export', [UserInformatiaonController::class, 'exportExcel'])->name('historyExport.user');



    Route::delete('user-information/{user}', [UserInformatiaonController::class, 'destroy'])->name('userInformation.destroy');
    Route::get('user-information/{user}', [UserInformatiaonController::class, 'show'])->name('userInformation.show');


    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
