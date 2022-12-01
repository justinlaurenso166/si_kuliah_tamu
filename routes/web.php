<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PICController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembicaraController;
use App\Http\Controllers\ArticleUserController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DokumentasiUserController;
use App\Http\Controllers\PresensiUserController;
use App\Http\Controllers\ProfileMahasiswaUserController;

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
    return view('welcome');
});

Route::get('/login',[ LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register',[ RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');


Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboardadmin.index')->middleware('admin');
Route::resource('/admin/mahasiswa', MahasiswaController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/proposal', ProposalController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/pic', PICController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/documentation', DokumentasiController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/post', PostsController::class)->middleware('admin');
Route::resource('/admin/presensi', PresensiController::class)->only('index')->middleware('admin');
Route::resource('/admin/pembicara', PembicaraController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/event', EventController::class)->except(['show'])->middleware('admin');
Route::resource('/admin/registeradmin', RegisterAdminController::class)->except(['show','edit','update'])->middleware('admin');


Route::post('/admin/event/pembicara', [EventController::class, 'storePembicara'])->name('event.storePembicara')->middleware('admin');
Route::get('/admin/event/pembicara/{id}', [EventController::class, 'editPembicara'])->name('event.editPembicara')->middleware('admin');
Route::delete('/admin/event/{id_event}/pembicara/{id_pembicara}', [EventController::class, 'destroyPembicara'])->name('event.destroyPembicara')->middleware('admin');

Route::get('/admin/event/{id_event}/sertifikat/{id_pembicara}', [EventController::class, 'editSertifikat'])->name('event.editSertifikat')->middleware('admin');
Route::put('/admin/event/{id_event}/sertifikat/{id_pembicara}', [EventController::class, 'updateSertifikat'])->name('event.updateSertifikat')->middleware('admin');

Route::get('/admin/event/laporanakhir/{id}', [EventController::class, 'editLaporanAkhir'])->name('event.editLaporanAkhir')->middleware('admin');
Route::put('/admin/event/laporanakhir/{id}', [EventController::class, 'updateLaporanAkhir'])->name('event.updateLaporanAkhir')->middleware('admin');

//Download Images
// Route::get('/downloadfoto/{image}', [DownloadController::class, 'photoDokumentasi'])->name('download.photoDokumentasi')->middleware('guest');
// Route::get('/downloadpdf/{image}', [DownloadController::class, 'pdfDokumentasi'])->name('download.pdfDokumentasi')->middleware('guest');
// Route::get('/downloadbackground/{image}', [DownloadController::class, 'photoBackground'])->name('download.photoBackground')->middleware('guest');
// Route::get('/downloadflyer/{image}', [DownloadController::class, 'photoFlyer'])->name('download.photoFlyer')->middleware('guest');
// Route::get('/downloadlaporanakhir/{image}', [DownloadController::class, 'pdfLaporanAkhir'])->name('download.pdfLaporanAkhir')->middleware('guest');
// Route::get('/downloadpembicara/{image}', [DownloadController::class, 'photoPembicara'])->name('download.photoPembicara')->middleware('guest');
// Route::get('/downloadcv/{image}', [DownloadController::class, 'pdfCV'])->name('download.pdfCV')->middleware('guest');
// Route::get('/downloadsertifikat/{image}', [DownloadController::class, 'photoSertifikat'])->name('download.photoSertifikat')->middleware('guest');
// Route::get('/downloadproposal/{image}', [DownloadController::class, 'pdfProposal'])->name('download.pdfProposal')->middleware('guest');
Route::get('/download',[DownloadController::class, 'index'])->name('download.index');

// Dashboard User
Route::get('/user/about', [DashboardUserController::class, 'index'])->name('dashboarduser.index');

Route::get('/user/profile', [ProfileMahasiswaUserController::class, 'index'])->name('profilemahasiswauser.index');

Route::get('/user/article', [ArticleUserController::class, 'index'])->name('article.index');
Route::get('/user/article/{id}', [ArticleUserController::class, 'show'])->name('article.show');

Route::get('/user/documentation', [DokumentasiUserController::class, 'index'])->name('documentationuser.index');
Route::get('/user/documentation/{id}', [DokumentasiUserController::class, 'show'])->name('documentationuser.show');

Route::get('/user/eventuser', [EventUserController::class, 'index'])->name('eventuser.index');
Route::get('/user/eventuser/{id}', [EventUserController::class, 'show'])->name('eventuser.show');
Route::get('/user/eventuser/create/{id}', [EventUserController::class, 'create'])->name('eventuser.create')->middleware('auth');
Route::post('/user/eventuser/store/{id}', [EventUserController::class, 'store'])->name('eventuser.store')->middleware('auth');
Route::get('/user/presensi/nim/{nim}', [EventUserController::class, 'nim'])->name('eventuser.nim');
