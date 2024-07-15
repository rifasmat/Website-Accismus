<?php

use Illuminate\Support\Facades\Route;

// Home Controller
use App\Http\Controllers\Home\HomeController;

// Login Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Administrator
use App\Http\Controllers\Administrator\AdministratorHomeController;
use App\Http\Controllers\Administrator\AdministratorDashboardController;
use App\Http\Controllers\Administrator\AdministratorInformasiController;
use App\Http\Controllers\Administrator\AdministratorBenefitController;
use App\Http\Controllers\Administrator\AdministratorHistoryController;
use App\Http\Controllers\Administrator\AdministratorTeamController;
use App\Http\Controllers\Administrator\AdministratorAboutController;
use App\Http\Controllers\Administrator\AdministratorBroadcastController;
use App\Http\Controllers\Administrator\AdministratorGalleryController;
use App\Http\Controllers\Administrator\AdministratorMemberController;
use App\Http\Controllers\Administrator\AdministratorPenggunaController;
use App\Http\Controllers\Administrator\AdministratorRequestController;

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
use App\Http\Controllers\Moderator\ModeratorPenggunaController;
use App\Http\Controllers\Moderator\ModeratorRequestController;

// Member
use App\Http\Controllers\Member\MemberHomeController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\MemberHistoryController;
use App\Http\Controllers\Member\MemberTeamController;
use App\Http\Controllers\Member\MemberGalleryController;
use App\Http\Controllers\Member\MemberMemberController;
use App\Http\Controllers\Member\MemberPenggunaController;

// Guest
use App\Http\Controllers\Guest\GuestHomeController;
use App\Http\Controllers\Guest\GuestDashboardController;
use App\Http\Controllers\Guest\GuestHistoryController;
use App\Http\Controllers\Guest\GuestTeamController;
use App\Http\Controllers\Guest\GuestGalleryController;
use App\Http\Controllers\Guest\GuestMemberController;
use App\Http\Controllers\Guest\GuestPenggunaController;

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
Route::get('login', [LoginController::class, 'login'])->name('login');
// Proses Login
Route::post('processLogin', [LoginController::class, 'processLogin'])->name('processLogin');

// Halaman Register
Route::get('register', [RegisterController::class, 'register'])->name('register');
// Proses Register
Route::post('processRegister', [RegisterController::class, 'processRegister'])->name('processRegister');

// forgot password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// reset password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Logout
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Route untuk nemapilkan 404 notfound
Route::get('/not-found', function () {
    return view('errors.404');
});

// Administrator
Route::group(['middleware' => 'auth.administrator'], function () {
    // administrator Home
    Route::get('/administrator/home', [AdministratorHomeController::class, 'index'])->name('administrator.home');

    // administrator dashboard
    Route::get('/administrator/dashboard/list', [AdministratorDashboardController::class, 'index'])->name('administrator.dashboard.list');

    // administrator informasi
    Route::get('/administrator/informasi', [AdministratorInformasiController::class, 'index'])->name('administrator.informasi.list');
    // administrator informasi update edit
    Route::put('/administrator/informasi/{uuid}', [AdministratorInformasiController::class, 'update'])->name('administrator.informasi.update');

    // administrator about
    Route::get('/administrator/about', [AdministratorAboutController::class, 'index'])->name('administrator.about.list');
    // administrator about update edit
    Route::put('/administrator/about/{uuid}', [AdministratorAboutController::class, 'update'])->name('administrator.about.update');

    // administrator benefit
    Route::get('/administrator/benefit', [AdministratorBenefitController::class, 'index'])->name('administrator.benefit.list');
    // administrator benefit update edit
    Route::put('/administrator/benefit/{uuid}', [AdministratorBenefitController::class, 'update'])->name('administrator.benefit.update');

    // administrator history tanpa show
    Route::resource('/administrator/history-rf', AdministratorHistoryController::class)
        ->except(['show'])
        ->parameters(['history' => 'history_uuid'])
        ->names([
            'index' => 'administrator.history-rf.list',
            'create' => 'administrator.history-rf.create',
            'store' => 'administrator.history-rf.store',
            'edit' => 'administrator.history-rf.edit',
            'update' => 'administrator.history-rf.update',
            'destroy' => 'administrator.history-rf.destroy',
        ]);

    // administrator history route search
    Route::get('/administrator/history-rf/search', [AdministratorHistoryController::class, 'search'])->name('administrator.history-rf.search');
    // administrator history konfirmasi
    Route::get('/administrator/history-rf/{uuid}/konfirmasi', [AdministratorHistoryController::class, 'konfirmasi'])->name('administrator.history-rf.konfirmasi');

    // administrator team tanpa show, create, store, destroy
    Route::resource('/administrator/team', AdministratorTeamController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['team' => 'uuid'])
        ->names([
            'index' => 'administrator.team.list',
            'edit' => 'administrator.team.edit',
            'update' => 'administrator.team.update',
        ]);

    // administrator team route search
    Route::get('/administrator/team/search', [AdministratorTeamController::class, 'search'])->name('administrator.team.search');

    // administrator gallery tanpa show
    Route::resource('/administrator/gallery', AdministratorGalleryController::class)
        ->except(['show'])
        ->parameters(['gallery' => 'gallery_uuid'])
        ->names([
            'index' => 'administrator.gallery.list',
            'create' => 'administrator.gallery.create',
            'store' => 'administrator.gallery.store',
            'edit' => 'administrator.gallery.edit',
            'update' => 'administrator.gallery.update',
            'destroy' => 'administrator.gallery.destroy',
        ]);
    // administrator gallery route search
    Route::get('/administrator/gallery/search', [AdministratorGalleryController::class, 'search'])->name('administrator.gallery.search');
    // administrator gallery konfirmasi
    Route::get('/administrator/gallery/{uuid}/konfirmasi', [AdministratorGalleryController::class, 'konfirmasi'])->name('administrator.gallery.konfirmasi');

    // administrator broadcast tanpa show, edit, destroy, update
    Route::resource('/administrator/broadcast', AdministratorBroadcastController::class)
        ->except(['show', 'edit', 'destroy', 'update'])
        ->parameters(['broadcast' => 'broadcast_uuid'])
        ->names([
            'index' => 'administrator.broadcast.history',
            'create' => 'administrator.broadcast.create',
            'store' => 'administrator.broadcast.store',
        ]);
    // administrator broadcast email terdaftar
    Route::get('/administrator/broadcast/email', [AdministratorBroadcastController::class, 'email'])->name('administrator.broadcast.email');
    // administrator broadcast route search history broadcast
    Route::get('/administrator/broadcast/search', [AdministratorBroadcastController::class, 'search'])->name('administrator.broadcast.search');
    // administrator broadcast route search daftar email
    Route::get('/administrator/broadcast/searchmail', [AdministratorBroadcastController::class, 'searchMail'])->name('administrator.broadcast.searchmail');

    // administrator request member
    Route::get('/administrator/request-member', [AdministratorRequestController::class, 'index'])->name('administrator.request-member.list');
    // administrator request-member route search
    Route::get('/administrator/request-member/search', [AdministratorRequestController::class, 'search'])->name('administrator.request-member.search');
    // administrator request-member route change-status
    Route::patch('/administrator/request-member/{uuid}/change-status', [AdministratorRequestController::class, 'changeStatus'])->name('administrator.request-member.changeStatus');

    // administrator member tanpa show, create, store, destroy
    Route::resource('/administrator/member', AdministratorMemberController::class)
        ->except(['show', 'create', 'store', 'destroy'])
        ->parameters(['member' => 'uuid'])
        ->names([
            'index' => 'administrator.member.list',
            'edit' => 'administrator.member.edit',
            'update' => 'administrator.member.update',
        ]);
    // administrator member route search
    Route::get('/administrator/member/search', [AdministratorMemberController::class, 'search'])->name('administrator.member.search');
    // administrator member route change-status
    Route::patch('/administrator/member/{uuid}/change-status', [AdministratorMemberController::class, 'changeStatus'])->name('administrator.member.changeStatus');

    // administrator pengguna tanpa show
    Route::resource('/administrator/pengguna', AdministratorPenggunaController::class)
        ->except(['show'])
        ->parameters(['pengguna' => 'uuid'])
        ->names([
            'index' => 'administrator.pengguna.list',
            'create' => 'administrator.pengguna.create',
            'store' => 'administrator.pengguna.store',
            'edit' => 'administrator.pengguna.edit',
            'update' => 'administrator.pengguna.update',
            'destroy' => 'administrator.pengguna.destroy',
        ]);
    // administrator pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/administrator/pengguna/{uuid}/konfirmasi', [AdministratorPenggunaController::class, 'konfirmasi'])->name('administrator.pengguna.konfirmasi');
    // Rute untuk menampilkan profil pengguna
    Route::get('/administrator/pengguna/profil', [AdministratorPenggunaController::class, 'profil'])->name('administrator.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/administrator/pengguna/updateprofil', [AdministratorPenggunaController::class, 'updateProfil'])->name('administrator.pengguna.updateprofil');
    // administrator pengguna route search
    Route::get('/administrator/pengguna/search', [AdministratorPenggunaController::class, 'search'])->name('administrator.pengguna.search');

    // administrator profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/administrator/profil/list', [AdministratorPenggunaController::class, 'profil'])->name('administrator.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/administrator/profil/profil/{uuid}', [AdministratorPenggunaController::class, 'updateProfil'])->name('administrator.profil.update');
});

// Guild Leader
Route::group(['middleware' => 'auth.guildleader'], function () {
    // guild leader Home
    Route::get('/guildleader/home', [GuildLeaderHomeController::class, 'index'])->name('guildleader.home');

    // guild leader dashboard
    Route::get('/guildleader/dashboard/list', [GuildLeaderDashboardController::class, 'index'])->name('guildleader.dashboard.list');

    // guild leader informasi
    Route::get('/guildleader/informasi', [GuildLeaderInformasiController::class, 'index'])->name('guildleader.informasi.list');
    // guild leader informasi update edit
    Route::put('/guildleader/informasi/{uuid}', [GuildLeaderInformasiController::class, 'update'])->name('guildleader.informasi.update');

    // guild leader about
    Route::get('/guildleader/about', [GuildLeaderAboutController::class, 'index'])->name('guildleader.about.list');
    // guild leader about update edit
    Route::put('/guildleader/about/{uuid}', [GuildLeaderAboutController::class, 'update'])->name('guildleader.about.update');

    // guild leader benefit
    Route::get('/guildleader/benefit', [GuildLeaderBenefitController::class, 'index'])->name('guildleader.benefit.list');
    // guild leader benefit update edit
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
    // guild leader gallery konfirmasi
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
    // guildleader pengguna route search
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

    // moderator history 
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

    // moderator member
    Route::get('/moderator/member', [ModeratorMemberController::class, 'index'])->name('moderator.member.list');
    // moderator member route search
    Route::get('/moderator/member/search', [ModeratorMemberController::class, 'search'])->name('moderator.member.search');
    // moderator member route change-status
    Route::patch('/moderator/member/{uuid}/change-status', [ModeratorMemberController::class, 'changeStatus'])->name('moderator.member.changeStatus');

    // Rute untuk menampilkan profil pengguna
    Route::get('/moderator/pengguna/profil', [ModeratorPenggunaController::class, 'profil'])->name('moderator.pengguna.profil');
    // Rute untuk memperbarui profil pengguna
    Route::post('/moderator/pengguna/updateprofil', [ModeratorPenggunaController::class, 'updateProfil'])->name('moderator.pengguna.updateprofil');
    // moderator pengguna route search
    Route::get('/moderator/pengguna/search', [ModeratorPenggunaController::class, 'search'])->name('moderator.pengguna.search');

    // moderator profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/moderator/profil/list', [ModeratorPenggunaController::class, 'profil'])->name('moderator.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/moderator/profil/profil/{uuid}', [ModeratorPenggunaController::class, 'updateProfil'])->name('moderator.profil.update');
});

// Member
Route::group(['middleware' => 'auth.member'], function () {
    // member Home
    Route::get('/member/home', [MemberHomeController::class, 'index'])->name('member.home');

    // member dashboard
    Route::get('/member/dashboard/list', [MemberDashboardController::class, 'index'])->name('member.dashboard.list');

    // member history 
    Route::get('/member/history-rf', [MemberHistoryController::class, 'index'])->name('member.history-rf.list');
    // member history route search
    Route::get('/member/history-rf/search', [MemberHistoryController::class, 'search'])->name('member.history-rf.search');

    // member team
    Route::get('/member/team/list', [MemberTeamController::class, 'index'])->name('member.team.list');
    // member team route search
    Route::get('/member/team/search', [MemberTeamController::class, 'search'])->name('member.team.search');

    // member gallery 
    Route::get('/member/gallery', [MemberGalleryController::class, 'index'])->name('member.gallery.list');
    // member gallery route search
    Route::get('/member/gallery/search', [MemberGalleryController::class, 'search'])->name('member.gallery.search');

    // member list
    Route::get('/member/member/list', [MemberMemberController::class, 'index'])->name('member.member.list');
    // member member route search
    Route::get('/member/member/search', [MemberMemberController::class, 'search'])->name('member.member.search');

    // member profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/member/profil/list', [MemberPenggunaController::class, 'profil'])->name('member.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/member/profil/profil/{uuid}', [MemberPenggunaController::class, 'updateProfil'])->name('member.profil.update');
});

// Guest
Route::group(['middleware' => 'auth.guest'], function () {
    // guest Home
    Route::get('/guest/home', [GuestHomeController::class, 'index'])->name('guest.home');

    // guest dashboard
    Route::get('/guest/dashboard/list', [GuestDashboardController::class, 'index'])->name('guest.dashboard.list');

    // guest history 
    Route::get('/guest/history-rf', [GuestHistoryController::class, 'index'])->name('guest.history-rf.list');
    // guest history route search
    Route::get('/guest/history-rf/search', [GuestHistoryController::class, 'search'])->name('guest.history-rf.search');

    // guest team
    Route::get('/guest/team/list', [GuestTeamController::class, 'index'])->name('guest.team.list');
    // guest team route search
    Route::get('/guest/team/search', [GuestTeamController::class, 'search'])->name('guest.team.search');

    // guest gallery 
    Route::get('/guest/gallery', [GuestGalleryController::class, 'index'])->name('guest.gallery.list');
    // guest gallery route search
    Route::get('/guest/gallery/search', [GuestGalleryController::class, 'search'])->name('guest.gallery.search');

    // guest list
    Route::get('/guest/guest/list', [GuestMemberController::class, 'index'])->name('guest.member.list');
    // guest guest route search
    Route::get('/guest/guest/search', [GuestMemberController::class, 'search'])->name('guest.member.search');

    // guest profil
    // Route untuk menampilkan profil pengguna yang sedang login
    Route::get('/guest/profil/list', [GuestPenggunaController::class, 'profil'])->name('guest.profil.list');
    // Route untuk memperbarui profil pengguna
    Route::put('/guest/profil/profil/{uuid}', [GuestPenggunaController::class, 'updateProfil'])->name('guest.profil.update');
});
