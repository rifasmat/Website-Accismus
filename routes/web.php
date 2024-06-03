<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Humas\HumasDashboardController;
use App\Http\Controllers\Humas\HumasInformasiController;
use App\Http\Controllers\Humas\HumasBenefitController;
use App\Http\Controllers\Humas\HumasAboutController;
use App\Http\Controllers\Humas\HumasPenggunaController;

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

Route::get('/', function () {
    return view('home/home');
});



// Logout
Route::get('/home/logout', 'App\Http\Controllers\Home\HomeController@logout')->name('logout');

// Halaman Register
Route::get('/home/login', 'App\Http\Controllers\Home\HomeController@register')->name('register');
// Untuk proses Register
Route::post('/home/login', 'App\Http\Controllers\Home\HomeController@processLogin')->name('processlogin');

// Halaman Login
Route::get('/home/login', 'App\Http\Controllers\Home\HomeController@login')->name('login');
// Untuk proses Login
Route::post('/home/login', 'App\Http\Controllers\Home\HomeController@processLogin')->name('processlogin');

// Halaman Register
Route::get('/home/register', 'App\Http\Controllers\Home\HomeController@register')->name('register');
// Untuk proses registrasi
Route::post('/home/register', 'App\Http\Controllers\Home\HomeController@registerProcess')->name('register.process');

// humas
Route::group(['middleware' => 'auth.humas'], function () {
    // humas dashboard
    Route::get('/humas/dashboard/list', [HumasDashboardController::class, 'index'])->name('humas.dashboard.list');

    // humas informasi
    Route::get('/humas/informasi', [HumasInformasiController::class, 'index'])->name('humas.informasi.list');
    Route::put('/humas/informasi/{uuid}', [HumasInformasiController::class, 'update'])->name('humas.informasi.update');

    // humas about
    Route::get('/humas/about', [HumasAboutController::class, 'index'])->name('humas.about.list');
    Route::put('/humas/about/{uuid}', [HumasAboutController::class, 'update'])->name('humas.about.update');

    // humas benefit
    Route::get('/humas/benefit', [HumasBenefitController::class, 'index'])->name('humas.benefit.list');
    Route::put('/humas/benefit/{uuid}', [HumasBenefitController::class, 'update'])->name('humas.benefit.update');

    // humas pengguna tanpa show
    Route::resource('/humas/pengguna', HumasPenggunaController::class)->except(['show'])->parameters([
        'pengguna' => 'uuid',
    ])->names([
        'index' => 'humas.pengguna.list',
        'create' => 'humas.pengguna.create',
        'store' => 'humas.pengguna.store',
        'edit' => 'humas.pengguna.edit',
        'update' => 'humas.pengguna.update',
        'destroy' => 'humas.pengguna.destroy',
    ]);
    // humas pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/humas/pengguna/{uuid}/konfirmasi', [HumasPenggunaController::class, 'konfirmasi'])->name('humas.pengguna.konfirmasi');
});
