<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['guru'])->group(function () {
        Route::get('/guru/jadwal', [App\Http\Controllers\JadwalController::class, 'jadwal']);
        Route::get('/export/nilai/{id}', [App\Http\Controllers\ExportController::class, 'nilai'])->name('export.nilai');
        Route::post('/import/nilai-mapel', [App\Http\Controllers\ImportController::class, 'nilai'])->name('import.nilai');
        Route::resource('nilai-mapel', App\Http\Controllers\NilaiMapelController::class);
    });

    Route::middleware(['wali'])->group(function () {
        Route::get('/export/catatan', [App\Http\Controllers\ExportController::class, 'catatan'])->name('export.catatan');
        Route::post('/import/catatan-akademik', [App\Http\Controllers\ImportController::class, 'catatan'])->name('import.catatan');
        Route::resource('catatan', App\Http\Controllers\CatatanAkademikController::class);
        Route::get('/export/magang', [App\Http\Controllers\ExportController::class, 'magang'])->name('export.magang');
        Route::post('/import/nilai-magang', [App\Http\Controllers\ImportController::class, 'magang'])->name('import.magang');
        Route::resource('magang', App\Http\Controllers\MagangController::class);
        Route::get('/export/ekstra/{id}', [App\Http\Controllers\ExportController::class, 'ekstra'])->name('export.ekstra');
        Route::post('/import/nilai-ekstra', [App\Http\Controllers\ImportController::class, 'ekstra'])->name('import.ekstra');
        Route::resource('nilai-ekstra', App\Http\Controllers\NilaiEkstraController::class);
        Route::get('/wali/rapot', [App\Http\Controllers\HomeController::class, 'wali'])->name('wali.rapot');
        Route::get('/wali/cetak/rapot/{id}', [App\Http\Controllers\CetakController::class, 'waliRapot'])->name('wali.cetak.rapot');
    });

    Route::middleware(['siswa'])->group(function () {
        Route::get('/rapot', [App\Http\Controllers\HomeController::class, 'rapot'])->name('rapot');
    });

    Route::middleware(['admin'])->group(function () {
        Route::resource('ekstra', App\Http\Controllers\EkstraController::class);
        Route::resource('predikat', App\Http\Controllers\PredikatController::class);
        Route::resource('lulus', App\Http\Controllers\LulusController::class);
        Route::get('/jadwal/mapel', [App\Http\Controllers\JadwalController::class, 'mapel']);
        Route::resource('jadwal', App\Http\Controllers\JadwalController::class);
        Route::resource('kelas-siswa', App\Http\Controllers\KelasSiswaController::class);
        Route::resource('kelas-mapel', App\Http\Controllers\KelasMapelController::class);
        Route::resource('tahun', App\Http\Controllers\TahunController::class);
        Route::resource('guru', App\Http\Controllers\GuruController::class);
        Route::resource('siswa', App\Http\Controllers\SiswaController::class);
        Route::resource('kelas', App\Http\Controllers\KelasController::class);
        Route::resource('mapel', App\Http\Controllers\MapelController::class);
        Route::resource('prodi', App\Http\Controllers\ProdiController::class);
        Route::get('/user/reset/{id}', [App\Http\Controllers\UserController::class, 'reset'])->name('user.reset');
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::get('/admin/rapot', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('admin.rapot.index');
        Route::get('/admin/rapot/{id}', [App\Http\Controllers\HomeController::class, 'adminShow'])->name('admin.rapot.show');
        Route::get('/cetak/rapot/{siswa_id}/{tahun_id}', [App\Http\Controllers\CetakController::class, 'adminRapot'])->name('admin.cetak.rapot');
        Route::get('/setting', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
        Route::post('/setting', [App\Http\Controllers\HomeController::class, 'simpan'])->name('simpan');
    });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
