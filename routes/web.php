<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Humas\HumasDashboardController;
use App\Http\Controllers\Humas\HumasInformasiController;
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

// Humas
Route::group(['middleware' => 'auth.humas'], function () {
    // Humas Dashboard
    Route::get('/humas/dashboard/list', [HumasDashboardController::class, 'index'])->name('humas.dashboard.list');

    // Humas Informasi
    Route::get('/humas/informasi/list', [HumasInformasiController::class, 'index'])->name('humas.informasi.list');

    // Humas About
    Route::get('/humas/about/list', [HumasAboutController::class, 'index'])->name('humas.about.list');

    // Humas Pengguna tanpa show
    Route::resource('/humas/pengguna', HumasPenggunaController::class)->except(['show'])->names([
        'index' => 'humas.pengguna.list',
        'create' => 'humas.pengguna.create',
        'store' => 'humas.pengguna.store',
        'edit' => 'humas.pengguna.edit',
        'update' => 'humas.pengguna.update',
        'destroy' => 'humas.pengguna.destroy',
    ]);
});
