<?php

use App\Http\Controllers\data_kegiatan\DataKegiatan;
use App\Http\Controllers\data_kegiatan\DataPesertaKegiatan;
use App\Http\Controllers\data_pendaftaran\DataPendaftaran;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\landing_page\LandingPage;
use App\Http\Controllers\scan\ScanAbsen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;

Auth::routes();
Route::resource('/', LandingPage::class);
Route::get('/pendaftaran-kegiatan/{id}', [LandingPage::class, 'getDataKegiatan'])->name('getDataKegiatan');
Route::get('/cek-peserta/{id}', [LandingPage::class, 'cekPeserta'])->name('cekPeserta');

Route::resource('/scan', ScanAbsen::class);
Route::get('/data-peserta/{id}', [ScanAbsen::class, 'DataPeserta'])->name('dataPeserta');
Route::get('/scan-peserta/{id}', [ScanAbsen::class, 'ScanPeserta'])->name('ScanPeserta');
Route::post('/update-absen-peserta', [ScanAbsen::class, 'updateAbsenPeserta'])->name('updateAbsenPeserta');

// authentication
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
// Route::get('/auth', [LoginBasic::class, 'index'])->name('auth-login-basic');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
// Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::group(['prefix' => 'administrator', 'middleware' => ['role:super-admin, admin']], function () {
  // Main Page Route
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');

  //Data Peserta
  Route::resource('/data-pendaftaran', DataPendaftaran::class);
  Route::get('/get-data-pendaftaran', [DataPendaftaran::class, 'getData'])->name('getDataPendaftaran');
  Route::post('/generate-qr', [DataPendaftaran::class, 'generateQr'])->name('generateQr');
  Route::post('/add-kegiatan', [DataPendaftaran::class, 'addKegiatan'])->name('addKegiatan');

  //Data Kegiatan
  Route::resource('/data-kegiatan', DataKegiatan::class);
  Route::get('/get-data-kegiatan', [DataKegiatan::class, 'getDataKegiatan'])->name('getDataKegiatan');

  //Data Peserta Kegiatan
  Route::resource('/data-kegiatan-peserta', DataPesertaKegiatan::class);
  Route::post('/get-data-peserta-kegiatan/{id}', [DataPesertaKegiatan::class, 'getDataPesertaKegiatan'])->name(
    'getDataPesertaKegiatan'
  );
  Route::post('/delete-data-peserta-kegiatan', [DataPesertaKegiatan::class, 'deleteMultiSelect'])->name(
    'deleteMultiSelect'
  );
  Route::get('/cek-data-peserta/{id}', [DataPesertaKegiatan::class, 'cekDataPeserta'])->name('cekDataPeserta');
  Route::get('/data-dropdown', [DataPesertaKegiatan::class, 'getDataDropdown'])->name('getDataDropdown');
  Route::post('/import-data-peserta', [DataPesertaKegiatan::class, 'import'])->name('import');
});
// Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');
