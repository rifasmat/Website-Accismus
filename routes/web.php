<?php

use Illuminate\Support\Facades\Route;

// Home Controller
use App\Http\Controllers\Home\HomeController;

// Guild Leader
use App\Http\Controllers\GuildLeader\GuildLeaderHomeController;
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
use App\Http\Controllers\Humas\HumasHomeController;
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

// Senate
use App\Http\Controllers\Senate\SenateHomeController;
use App\Http\Controllers\Senate\SenateDashboardController;
use App\Http\Controllers\Senate\SenateInformasiController;
use App\Http\Controllers\Senate\SenateBenefitController;
use App\Http\Controllers\Senate\SenateHistoryController;
use App\Http\Controllers\Senate\SenateTeamController;
use App\Http\Controllers\Senate\SenateAboutController;
use App\Http\Controllers\Senate\SenateGalleryController;
use App\Http\Controllers\Senate\SenateMemberController;
use App\Http\Controllers\Senate\SenatePenggunaController;
use App\Http\Controllers\Senate\SenateRequestController;

// Moderator
use App\Http\Controllers\Moderator\ModeratorHomeController;
use App\Http\Controllers\Moderator\ModeratorDashboardController;
use App\Http\Controllers\Moderator\ModeratorInformasiController;
use App\Http\Controllers\Moderator\ModeratorBenefitController;
use App\Http\Controllers\Moderator\ModeratorHistoryController;
use App\Http\Controllers\Moderator\ModeratorTeamController;
use App\Http\Controllers\Moderator\ModeratorAboutController;
use App\Http\Controllers\Moderator\ModeratorGalleryController;
use App\Http\Controllers\Moderator\ModeratorMemberController;
use App\Http\Controllers\Moderator\ModeratorRequestController;


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
    // guild leader Home
    Route::get('/guildleader/home', [GuildLeaderHomeController::class, 'index'])->name('guildleader.home');

    // guild leader dashboard
    Route::get('/guildleader/dashboard/list', [GuildLeaderDashboardController::class, 'index'])->name('guildleader.dashboard.list');

    // guild leader dashboard
    Route::get('/guildleader/dashboard/list', [GuildLeaderDashboardController::class, 'index'])->name('guildleader.dashboard.list');

    // guild leader informasi
    Route::get('/guildleader/informasi', [GuildLeaderInformasiController::class, 'index'])->name('guildleader.informasi.list');
    // guild leader informasi update edit
    Route::put('/guildleader/informasi/{uuid}', [GuildLeaderInformasiController::class, 'update'])->name('guildleader.informasi.update');

    // guild leader about
    Route::get('/guildleader/about', [GuildLeaderAboutController::class, 'index'])->name('guildleader.about.list');
    // guil dleader about update edit
    Route::put('/guildleader/about/{uuid}', [GuildLeaderAboutController::class, 'update'])->name('guildleader.about.update');

    // guild leader benefit
    Route::get('/guildleader/benefit', [GuildLeaderBenefitController::class, 'index'])->name('guildleader.benefit.list');
    // guildleader benefit update edit
    Route::put('/guildleader/benefit/{uuid}', [GuildLeaderBenefitController::class, 'update'])->name('guildleader.benefit.update');

    // guild leader history tanpa show
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

    // guild leader history route search
    Route::get('/guildleader/history-rf/search', [GuildLeaderHistoryController::class, 'search'])->name('guildleader.history-rf.search');
    // guild leader history konfirmasi
    Route::get('/guildleader/history-rf/{uuid}/konfirmasi', [GuildLeaderHistoryController::class, 'konfirmasi'])->name('guildleader.history-rf.konfirmasi');

    // guild leader team tanpa show, create, store, destroy
    Route::resource('/guildleader/team', GuildLeaderTeamController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['team' => 'uuid'])
        ->names([
            'index' => 'guildleader.team.list',
            'edit' => 'guildleader.team.edit',
            'update' => 'guildleader.team.update',
        ]);

    // guild leader team route search
    Route::get('/guildleader/team/search', [GuildLeaderTeamController::class, 'search'])->name('guildleader.team.search');

    // guild leader gallery tanpa show
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
    // guild leader gallery route search
    Route::get('/guildleader/gallery/search', [GuildLeaderGalleryController::class, 'search'])->name('guildleader.gallery.search');
    // guildleader gallery konfirmasi
    Route::get('/guildleader/gallery/{uuid}/konfirmasi', [GuildLeaderGalleryController::class, 'konfirmasi'])->name('guildleader.gallery.konfirmasi');

    // guild leader broadcast tanpa show, edit, destroy, update
    Route::resource('/guildleader/broadcast', GuildLeaderBroadcastController::class)
        ->except(['show', 'edit', 'destroy', 'update'])
        ->parameters(['broadcast' => 'broadcast_uuid'])
        ->names([
            'index' => 'guildleader.broadcast.history',
            'create' => 'guildleader.broadcast.create',
            'store' => 'guildleader.broadcast.store',
        ]);
    // guild leader broadcast email terdaftar
    Route::get('/guildleader/broadcast/email', [GuildLeaderBroadcastController::class, 'email'])->name('guildleader.broadcast.email');
    // guild leader broadcast route search history broadcast
    Route::get('/guildleader/broadcast/search', [GuildLeaderBroadcastController::class, 'search'])->name('guildleader.broadcast.search');
    // guild leader broadcast route search daftar email
    Route::get('/guildleader/broadcast/searchmail', [GuildLeaderBroadcastController::class, 'searchMail'])->name('guildleader.broadcast.searchmail');

    // guild leader request member
    Route::get('/guildleader/request-member', [GuildLeaderRequestController::class, 'index'])->name('guildleader.request-member.list');
    // guild leader request-member route search
    Route::get('/guildleader/request-member/search', [GuildLeaderRequestController::class, 'search'])->name('guildleader.request-member.search');
    // guild leader request-member route change-status
    Route::patch('/guildleader/request-member/{uuid}/change-status', [GuildLeaderRequestController::class, 'changeStatus'])->name('guildleader.request-member.changeStatus');

    // guild leader member tanpa show, create, store, destroy
    Route::resource('/guildleader/member', GuildLeaderMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'guildleader.member.list',
            'edit' => 'guildleader.member.edit',
            'update' => 'guildleader.member.update',
        ]);
    // guild leader member route search
    Route::get('/guildleader/member/search', [GuildLeaderMemberController::class, 'search'])->name('guildleader.member.search');
    // guild leader member route change-status
    Route::patch('/guildleader/member/{uuid}/change-status', [GuildLeaderMemberController::class, 'changeStatus'])->name('guildleader.member.changeStatus');

    // guild leader pengguna tanpa show
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
    // guild leader pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/guildleader/pengguna/{uuid}/konfirmasi', [GuildLeaderPenggunaController::class, 'konfirmasi'])->name('guildleader.pengguna.konfirmasi');
    // Rute untuk menampilkan profil pengguna
    Route::get('/guildleader/pengguna/profil', [GuildLeaderPenggunaController::class, 'profil'])->name('guildleader.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/guildleader/pengguna/updateprofil', [GuildLeaderPenggunaController::class, 'updateProfil'])->name('guildleader.pengguna.updateprofil');
    // guild leader pengguna route search
    Route::get('/guildleader/pengguna/search', [GuildLeaderPenggunaController::class, 'search'])->name('guildleader.pengguna.search');

    // guild leader profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/guildleader/profil/list', [GuildLeaderPenggunaController::class, 'profil'])->name('guildleader.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/guildleader/profil/profil/{uuid}', [GuildLeaderPenggunaController::class, 'updateProfil'])->name('guildleader.profil.update');
});


// Humas
Route::group(['middleware' => 'auth.humas'], function () {
    // humas Home
    Route::get('/humas/home', [HumasHomeController::class, 'index'])->name('humas.home');

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

// Senate
Route::group(['middleware' => 'auth.senate'], function () {
    // senate Home
    Route::get('/senate/home', [SenateHomeController::class, 'index'])->name('senate.home');

    // senate dashboard
    Route::get('/senate/dashboard/list', [SenateDashboardController::class, 'index'])->name('senate.dashboard.list');

    // senate informasi
    Route::get('/senate/informasi', [SenateInformasiController::class, 'index'])->name('senate.informasi.list');
    // senate informasi update edit
    Route::put('/senate/informasi/{uuid}', [SenateInformasiController::class, 'update'])->name('senate.informasi.update');

    // senate about
    Route::get('/senate/about', [SenateAboutController::class, 'index'])->name('senate.about.list');
    // senate about update edit
    Route::put('/senate/about/{uuid}', [SenateAboutController::class, 'update'])->name('senate.about.update');

    // senate benefit
    Route::get('/senate/benefit', [SenateBenefitController::class, 'index'])->name('senate.benefit.list');
    // senate benefit update edit
    Route::put('/senate/benefit/{uuid}', [SenateBenefitController::class, 'update'])->name('senate.benefit.update');

    // senate history tanpa show
    Route::resource('/senate/history-rf', SenateHistoryController::class)
        ->except(['show'])
        ->parameters(['history' => 'history_uuid'])
        ->names([
            'index' => 'senate.history-rf.list',
            'create' => 'senate.history-rf.create',
            'store' => 'senate.history-rf.store',
            'edit' => 'senate.history-rf.edit',
            'update' => 'senate.history-rf.update',
            'destroy' => 'senate.history-rf.destroy',
        ]);

    // senate history route search
    Route::get('/senate/history-rf/search', [SenateHistoryController::class, 'search'])->name('senate.history-rf.search');
    // senate history konfirmasi
    Route::get('/senate/history-rf/{uuid}/konfirmasi', [SenateHistoryController::class, 'konfirmasi'])->name('senate.history-rf.konfirmasi');

    // senate team tanpa show, create, store, destroy
    Route::resource('/senate/team', SenateTeamController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['team' => 'uuid'])
        ->names([
            'index' => 'senate.team.list',
            'edit' => 'senate.team.edit',
            'update' => 'senate.team.update',
        ]);

    // senate team route search
    Route::get('/senate/team/search', [SenateTeamController::class, 'search'])->name('senate.team.search');

    // senate gallery tanpa show
    Route::resource('/senate/gallery', SenateGalleryController::class)
        ->except(['show'])
        ->parameters(['gallery' => 'gallery_uuid'])
        ->names([
            'index' => 'senate.gallery.list',
            'create' => 'senate.gallery.create',
            'store' => 'senate.gallery.store',
            'edit' => 'senate.gallery.edit',
            'update' => 'senate.gallery.update',
            'destroy' => 'senate.gallery.destroy',
        ]);
    // senate gallery route search
    Route::get('/senate/gallery/search', [SenateGalleryController::class, 'search'])->name('senate.gallery.search');
    // senate gallery konfirmasi
    Route::get('/senate/gallery/{uuid}/konfirmasi', [SenateGalleryController::class, 'konfirmasi'])->name('senate.gallery.konfirmasi');

    // senate request member
    Route::get('/senate/request-member', [SenateRequestController::class, 'index'])->name('senate.request-member.list');
    // senate request-member route search
    Route::get('/senate/request-member/search', [SenateRequestController::class, 'search'])->name('senate.request-member.search');
    // senate request-member route change-status
    Route::patch('/senate/request-member/{uuid}/change-status', [SenateRequestController::class, 'changeStatus'])->name('senate.request-member.changeStatus');

    // senate member tanpa show, create, store, destroy
    Route::resource('/senate/member', SenateMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'senate.member.list',
            'edit' => 'senate.member.edit',
            'update' => 'senate.member.update',
        ]);
    // senate member route search
    Route::get('/senate/member/search', [SenateMemberController::class, 'search'])->name('senate.member.search');
    // senate member route change-status
    Route::patch('/senate/member/{uuid}/change-status', [SenateMemberController::class, 'changeStatus'])->name('senate.member.changeStatus');

    // senate pengguna tanpa show
    Route::resource('/senate/pengguna', SenatePenggunaController::class)
        ->except(['show'])
        ->parameters(['pengguna' => 'uuid'])
        ->names([
            'index' => 'senate.pengguna.list',
            'create' => 'senate.pengguna.create',
            'store' => 'senate.pengguna.store',
            'edit' => 'senate.pengguna.edit',
            'update' => 'senate.pengguna.update',
            'destroy' => 'senate.pengguna.destroy',
        ]);
    // senate pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/senate/pengguna/{uuid}/konfirmasi', [SenatePenggunaController::class, 'konfirmasi'])->name('senate.pengguna.konfirmasi');
    // Rute untuk menampilkan profil pengguna
    Route::get('/senate/pengguna/profil', [SenatePenggunaController::class, 'profil'])->name('senate.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/senate/pengguna/updateprofil', [SenatePenggunaController::class, 'updateProfil'])->name('senate.pengguna.updateprofil');
    // senate pengguna route search
    Route::get('/senate/pengguna/search', [SenatePenggunaController::class, 'search'])->name('senate.pengguna.search');

    // senate profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/senate/profil/list', [SenatePenggunaController::class, 'profil'])->name('senate.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/senate/profil/profil/{uuid}', [SenatePenggunaController::class, 'updateProfil'])->name('senate.profil.update');
});

// Moderator
Route::group(['middleware' => 'auth.moderator'], function () {
    // moderator Home
    Route::get('/moderator/home', [ModeratorHomeController::class, 'index'])->name('moderator.home');

    // moderator dashboard
    Route::get('/moderator/dashboard/list', [ModeratorDashboardController::class, 'index'])->name('moderator.dashboard.list');

    // moderator informasi
    Route::get('/moderator/informasi', [ModeratorInformasiController::class, 'index'])->name('moderator.informasi.list');

    // moderator about
    Route::get('/moderator/about', [ModeratorAboutController::class, 'index'])->name('moderator.about.list');

    // moderator benefit
    Route::get('/moderator/benefit', [ModeratorBenefitController::class, 'index'])->name('moderator.benefit.list');

    // moderator history rf
    Route::get('/moderator/history-rf', [ModeratorHistoryController::class, 'index'])->name('moderator.history-rf.list');
    // moderator history route search
    Route::get('/moderator/history-rf/search', [ModeratorHistoryController::class, 'search'])->name('moderator.history-rf.search');

    // moderator team 
    Route::get('/moderator/team', [ModeratorTeamController::class, 'index'])->name('moderator.team.list');
    // moderator team route search
    Route::get('/moderator/team/search', [ModeratorTeamController::class, 'search'])->name('moderator.team.search');

    // moderator gallery 
    Route::get('/moderator/gallery', [ModeratorGalleryController::class, 'index'])->name('moderator.gallery.list');
    // moderator gallery route search
    Route::get('/moderator/gallery/search', [ModeratorGalleryController::class, 'search'])->name('moderator.gallery.search');

    // moderator request member
    Route::get('/moderator/request-member', [ModeratorRequestController::class, 'index'])->name('moderator.request-member.list');
    // moderator request-member route search
    Route::get('/moderator/request-member/search', [ModeratorRequestController::class, 'search'])->name('moderator.request-member.search');
    // moderator request-member route change-status
    Route::patch('/moderator/request-member/{uuid}/change-status', [ModeratorRequestController::class, 'changeStatus'])->name('moderator.request-member.changeStatus');

    // moderator member tanpa show, create, store, destroy
    Route::resource('/moderator/member', ModeratorMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'moderator.member.list',
            'edit' => 'moderator.member.edit',
            'update' => 'moderator.member.update',
        ]);
    // moderator member route search
    Route::get('/moderator/member/search', [ModeratorMemberController::class, 'search'])->name('moderator.member.search');
    // moderator member route change-status
    Route::patch('/moderator/member/{uuid}/change-status', [ModeratorMemberController::class, 'changeStatus'])->name('moderator.member.changeStatus');

    // moderator profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/moderator/profil/list', [ModeratorPenggunaController::class, 'profil'])->name('moderator.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/moderator/profil/profil/{uuid}', [ModeratorPenggunaController::class, 'updateProfil'])->name('moderator.profil.update');
});
