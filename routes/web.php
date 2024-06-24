<?php

use Illuminate\Support\Facades\Route;
// Guild Leader
use App\Http\Controllers\GuildLeader\GuildLeaderDashboardController;
use App\Http\Controllers\GuildLeader\GuildLeaderInformasiController;
use App\Http\Controllers\GuildLeader\GuildLeaderBenefitController;
use App\Http\Controllers\GuildLeader\GuildLeaderHistoryController;
use App\Http\Controllers\GuildLeader\GuildLeaderTeamController;
use App\Http\Controllers\GuildLeader\GuildLeaderAboutController;
use App\Http\Controllers\GuildLeader\GuildLeaderBroadcastController;
use App\Http\Controllers\GuildLeader\GuildLeaderGalleryController;
use App\Http\Controllers\GuildLeader\GuildLeaderMemberController;
use App\Http\Controllers\GuildLeader\GuildLeaderPenggunaController;
use App\Http\Controllers\GuildLeader\GuildLeaderRequestController;

// Humas
use App\Http\Controllers\Humas\HumasDashboardController;
use App\Http\Controllers\Humas\HumasInformasiController;
use App\Http\Controllers\Humas\HumasBenefitController;
use App\Http\Controllers\Humas\HumasHistoryController;
use App\Http\Controllers\Humas\HumasTeamController;
use App\Http\Controllers\Humas\HumasAboutController;
use App\Http\Controllers\Humas\HumasBroadcastController;
use App\Http\Controllers\Humas\HumasGalleryController;
use App\Http\Controllers\Humas\HumasMemberController;
use App\Http\Controllers\Humas\HumasPenggunaController;
use App\Http\Controllers\Humas\HumasRequestController;
use App\Http\Controllers\Home\HomeController;

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



// Halaman Home
Route::get('/', [HomeController::class, 'index']);

// Halaman Login
Route::get('/home/login', [HomeController::class, 'login'])->name('login');
// Proses Login
Route::post('/home/processLogin', [HomeController::class, 'processLogin'])->name('processLogin');

// Halaman Register
Route::get('/home/register', [HomeController::class, 'register'])->name('register');
// Proses Register
Route::post('/home/processRegister', [HomeController::class, 'processRegister'])->name('processRegister');

// Logout
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// GUild Leader
Route::group(['middleware' => 'auth.guildleader'], function () {
    // humas dashboard
    Route::get('/guildleader/dashboard/list', [GuildLeaderDashboardController::class, 'index'])->name('guildleader.dashboard.list');

    // guildleader informasi
    Route::get('/guildleader/informasi', [GuildLeaderInformasiController::class, 'index'])->name('guildleader.informasi.list');
    // guildleader informasi update edit
    Route::put('/guildleader/informasi/{uuid}', [GuildLeaderInformasiController::class, 'update'])->name('guildleader.informasi.update');

    // guildleader about
    Route::get('/guildleader/about', [GuildLeaderAboutController::class, 'index'])->name('guildleader.about.list');
    // guildleader about update edit
    Route::put('/guildleader/about/{uuid}', [GuildLeaderAboutController::class, 'update'])->name('guildleader.about.update');

    // guildleader benefit
    Route::get('/guildleader/benefit', [GuildLeaderBenefitController::class, 'index'])->name('guildleader.benefit.list');
    // guildleader benefit update edit
    Route::put('/guildleader/benefit/{uuid}', [GuildLeaderBenefitController::class, 'update'])->name('guildleader.benefit.update');

    // guildleader history tanpa show
    Route::resource('/guildleader/history-rf', GuildLeaderHistoryController::class)
        ->except(['show'])
        ->parameters(['history' => 'history_uuid'])
        ->names([
            'index' => 'guildleader.history-rf.list',
            'create' => 'guildleader.history-rf.create',
            'store' => 'guildleader.history-rf.store',
            'edit' => 'guildleader.history-rf.edit',
            'update' => 'guildleader.history-rf.update',
            'destroy' => 'guildleader.history-rf.destroy',
        ]);

    // guildleader history route search
    Route::get('/guildleader/history-rf/search', [GuildLeaderHistoryController::class, 'search'])->name('guildleader.history-rf.search');
    // guildleader history konfirmasi
    Route::get('/guildleader/history-rf/{uuid}/konfirmasi', [GuildLeaderHistoryController::class, 'konfirmasi'])->name('guildleader.history-rf.konfirmasi');

    // guildleader team tanpa show, create, store, destroy
    Route::resource('/guildleader/team', GuildLeaderTeamController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['team' => 'uuid'])
        ->names([
            'index' => 'guildleader.team.list',
            'edit' => 'guildleader.team.edit',
            'update' => 'guildleader.team.update',
        ]);

    // guildleader team route search
    Route::get('/guildleader/team/search', [GuildLeaderTeamController::class, 'search'])->name('guildleader.team.search');

    // guildleader gallery tanpa show
    Route::resource('/guildleader/gallery', GuildLeaderGalleryController::class)
        ->except(['show'])
        ->parameters(['gallery' => 'gallery_uuid'])
        ->names([
            'index' => 'guildleader.gallery.list',
            'create' => 'guildleader.gallery.create',
            'store' => 'guildleader.gallery.store',
            'edit' => 'guildleader.gallery.edit',
            'update' => 'guildleader.gallery.update',
            'destroy' => 'guildleader.gallery.destroy',
        ]);
    // guildleader gallery route search
    Route::get('/guildleader/gallery/search', [GuildLeaderGalleryController::class, 'search'])->name('guildleader.gallery.search');
    // guildleader gallery konfirmasi
    Route::get('/guildleader/gallery/{uuid}/konfirmasi', [GuildLeaderGalleryController::class, 'konfirmasi'])->name('guildleader.gallery.konfirmasi');

    // guildleader broadcast tanpa show, edit, destroy, update
    Route::resource('/guildleader/broadcast', GuildLeaderBroadcastController::class)
        ->except(['show', 'edit', 'destroy', 'update'])
        ->parameters(['broadcast' => 'broadcast_uuid'])
        ->names([
            'index' => 'guildleader.broadcast.history',
            'create' => 'guildleader.broadcast.create',
            'store' => 'guildleader.broadcast.store',
        ]);
    // guildleader broadcast email terdaftar
    Route::get('/guildleader/broadcast/email', [GuildLeaderBroadcastController::class, 'email'])->name('guildleader.broadcast.email');
    // guildleader broadcast route search history broadcast
    Route::get('/guildleader/broadcast/search', [GuildLeaderBroadcastController::class, 'search'])->name('guildleader.broadcast.search');
    // guildleader broadcast route search daftar email
    Route::get('/guildleader/broadcast/searchmail', [GuildLeaderBroadcastController::class, 'searchMail'])->name('guildleader.broadcast.searchmail');

    // guildleader request member
    Route::get('/guildleader/request-member', [GuildLeaderRequestController::class, 'index'])->name('guildleader.request-member.list');
    // guildleader request-member route search
    Route::get('/guildleader/request-member/search', [GuildLeaderRequestController::class, 'search'])->name('guildleader.request-member.search');
    // guildleader request-member route change-status
    Route::patch('/guildleader/request-member/{uuid}/change-status', [GuildLeaderRequestController::class, 'changeStatus'])->name('guildleader.request-member.changeStatus');

    // guildleader member tanpa show, create, store, destroy
    Route::resource('/guildleader/member', GuildLeaderMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'guildleader.member.list',
            'edit' => 'guildleader.member.edit',
            'update' => 'guildleader.member.update',
        ]);
    // guildleader member route search
    Route::get('/guildleader/member/search', [GuildLeaderMemberController::class, 'search'])->name('guildleader.member.search');
    // guildleader member route change-status
    Route::patch('/guildleader/member/{uuid}/change-status', [GuildLeaderMemberController::class, 'changeStatus'])->name('guildleader.member.changeStatus');

    // guildleader pengguna tanpa show
    Route::resource('/guildleader/pengguna', GuildLeaderPenggunaController::class)
        ->except(['show'])
        ->parameters(['pengguna' => 'uuid'])
        ->names([
            'index' => 'guildleader.pengguna.list',
            'create' => 'guildleader.pengguna.create',
            'store' => 'guildleader.pengguna.store',
            'edit' => 'guildleader.pengguna.edit',
            'update' => 'guildleader.pengguna.update',
            'destroy' => 'guildleader.pengguna.destroy',
        ]);
    // guildleader pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/guildleader/pengguna/{uuid}/konfirmasi', [GuildLeaderPenggunaController::class, 'konfirmasi'])->name('guildleader.pengguna.konfirmasi');
    // Rute untuk menampilkan profil pengguna
    Route::get('/guildleader/pengguna/profil', [GuildLeaderPenggunaController::class, 'profil'])->name('guildleader.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/guildleader/pengguna/updateprofil', [GuildLeaderPenggunaController::class, 'updateProfil'])->name('guildleader.pengguna.updateprofil');
    // guildleader pengguna route search
    Route::get('/guildleader/pengguna/search', [GuildLeaderPenggunaController::class, 'search'])->name('guildleader.pengguna.search');

    // guildleader profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/guildleader/profil/list', [GuildLeaderPenggunaController::class, 'profil'])->name('guildleader.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/guildleader/profil/profil/{uuid}', [GuildLeaderPenggunaController::class, 'updateProfil'])->name('guildleader.profil.update');
});


// Humas
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

    // humas history tanpa show
    Route::resource('/humas/history-rf', HumasHistoryController::class)
        ->except(['show'])
        ->parameters(['history' => 'history_uuid'])
        ->names([
            'index' => 'humas.history-rf.list',
            'create' => 'humas.history-rf.create',
            'store' => 'humas.history-rf.store',
            'edit' => 'humas.history-rf.edit',
            'update' => 'humas.history-rf.update',
            'destroy' => 'humas.history-rf.destroy',
        ]);

    // humas history route search
    Route::get('/humas/history-rf/search', [HumasHistoryController::class, 'search'])->name('humas.history-rf.search');
    // humas history konfirmasi
    Route::get('/humas/history-rf/{uuid}/konfirmasi', [HumasHistoryController::class, 'konfirmasi'])->name('humas.history-rf.konfirmasi');

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

    // humas broadcast tanpa show, edit, destroy, update
    Route::resource('/humas/broadcast', HumasBroadcastController::class)
        ->except(['show', 'edit', 'destroy', 'update'])
        ->parameters(['broadcast' => 'broadcast_uuid'])
        ->names([
            'index' => 'humas.broadcast.history',
            'create' => 'humas.broadcast.create',
            'store' => 'humas.broadcast.store',
        ]);
    // humas broadcast email terdaftar
    Route::get('/humas/broadcast/email', [HumasBroadcastController::class, 'email'])->name('humas.broadcast.email');
    // humas broadcast route search history broadcast
    Route::get('/humas/broadcast/search', [HumasBroadcastController::class, 'search'])->name('humas.broadcast.search');
    // humas broadcast route search daftar email
    Route::get('/humas/broadcast/searchmail', [HumasBroadcastController::class, 'searchMail'])->name('humas.broadcast.searchmail');

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
