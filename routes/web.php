<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Humas\HumasDashboardController;
use App\Http\Controllers\Humas\HumasInformasiController;
use App\Http\Controllers\Humas\HumasBenefitController;
use App\Http\Controllers\Humas\HumasTeamController;
use App\Http\Controllers\Humas\HumasAboutController;
use App\Http\Controllers\Humas\HumasGalleryController;
use App\Http\Controllers\Humas\HumasMemberController;
use App\Http\Controllers\Humas\HumasPenggunaController;
use App\Http\Controllers\Humas\HumasRequestController;

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
    // humas informasi update edit
    Route::put('/humas/informasi/{uuid}', [HumasInformasiController::class, 'update'])->name('humas.informasi.update');

    // humas about
    Route::get('/humas/about', [HumasAboutController::class, 'index'])->name('humas.about.list');
    // humas about update edit
    Route::put('/humas/about/{uuid}', [HumasAboutController::class, 'update'])->name('humas.about.update');

    // humas benefit
    Route::get('/humas/benefit', [HumasBenefitController::class, 'index'])->name('humas.benefit.list');
    // humas benefit update edit
    Route::put('/humas/benefit/{uuid}', [HumasBenefitController::class, 'update'])->name('humas.benefit.update');

    // humas team tanpa show, create, store, destroy
    Route::resource('/humas/team', HumasTeamController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['team' => 'uuid'])
        ->names([
            'index' => 'humas.team.list',
            'edit' => 'humas.team.edit',
            'update' => 'humas.team.update',
        ]);
    // humas team route search
    Route::get('/humas/team/search', [HumasTeamController::class, 'search'])->name('humas.team.search');

    // humas gallery tanpa show
    Route::resource('/humas/gallery', HumasGalleryController::class)
        ->except(['show'])
        ->parameters(['gallery' => 'gallery_uuid'])
        ->names([
            'index' => 'humas.gallery.list',
            'create' => 'humas.gallery.create',
            'store' => 'humas.gallery.store',
            'edit' => 'humas.gallery.edit',
            'update' => 'humas.gallery.update',
            'destroy' => 'humas.gallery.destroy',
        ]);
    // humas gallery route search
    Route::get('/humas/gallery/search', [HumasGalleryController::class, 'search'])->name('humas.gallery.search');
    // humas gallery konfirmasi
    Route::get('/humas/gallery/{uuid}/konfirmasi', [HumasGalleryController::class, 'konfirmasi'])->name('humas.gallery.konfirmasi');

    // humas request member
    Route::get('/humas/request-member', [HumasRequestController::class, 'index'])->name('humas.request-member.list');
    // humas request-member route search
    Route::get('/humas/request-member/search', [HumasRequestController::class, 'search'])->name('humas.request-member.search');
    // humas request-member route change-status
    Route::patch('/humas/request-member/{uuid}/change-status', [HumasRequestController::class, 'changeStatus'])->name('humas.request-member.changeStatus');

    // humas member tanpa show, create, store, destroy
    Route::resource('/humas/member', HumasMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'humas.member.list',
            'edit' => 'humas.member.edit',
            'update' => 'humas.member.update',
        ]);
    // humas member route search
    Route::get('/humas/member/search', [HumasMemberController::class, 'search'])->name('humas.member.search');
    // humas member route change-status
    Route::patch('/humas/member/{uuid}/change-status', [HumasMemberController::class, 'changeStatus'])->name('humas.member.changeStatus');

    // humas pengguna tanpa show
    Route::resource('/humas/pengguna', HumasPenggunaController::class)
        ->except(['show'])
        ->parameters(['pengguna' => 'uuid'])
        ->names([
            'index' => 'humas.pengguna.list',
            'create' => 'humas.pengguna.create',
            'store' => 'humas.pengguna.store',
            'edit' => 'humas.pengguna.edit',
            'update' => 'humas.pengguna.update',
            'destroy' => 'humas.pengguna.destroy',
        ]);
    // humas pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/humas/pengguna/{uuid}/konfirmasi', [HumasPenggunaController::class, 'konfirmasi'])->name('humas.pengguna.konfirmasi');
    // Rute untuk menampilkan profil pengguna
    Route::get('/humas/pengguna/profil', [HumasPenggunaController::class, 'profil'])->name('humas.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/humas/pengguna/updateprofil', [HumasPenggunaController::class, 'updateProfil'])->name('humas.pengguna.updateprofil');
    // humas pengguna route search
    Route::get('/humas/pengguna/search', [HumasPenggunaController::class, 'search'])->name('humas.pengguna.search');

    // humas profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/humas/profil/list', [HumasPenggunaController::class, 'profil'])->name('humas.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/humas/profil/profil/{uuid}', [HumasPenggunaController::class, 'updateProfil'])->name('humas.profil.update');
});
