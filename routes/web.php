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
        Route::resource('nilai-mapel', App\Http\Controllers\NilaiMapelController::class);
    });

    Route::middleware(['wali'])->group(function () {
        Route::resource('catatan', App\Http\Controllers\CatatanAkademikController::class);
        Route::resource('magang', App\Http\Controllers\MagangController::class);
        Route::resource('nilai-ekstra', App\Http\Controllers\NilaiEkstraController::class);
        Route::get('/wali/rapot', function () {
            return view('wali.rapot');
        })->name('wali.rapot');
    });

    Route::middleware(['siswa'])->group(function () {
        Route::get('/rapot', function () {
            return view('siswa.index');
        })->name('rapot');
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
        Route::get('/admin/rapot', function () {
            return view('admin.rapot.index');
        })->name('admin.rapot.index');
        Route::get('/admin/rapot/{id}', function ($id) {
            $id = $id;
            return view('admin.rapot.show', compact('id'));
        })->name('admin.rapot.show');
        Route::get('/setting', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
        Route::post('/setting', [App\Http\Controllers\HomeController::class, 'simpan'])->name('simpan');
    });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
