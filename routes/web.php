<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\PemasukanEmailController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');

Route::middleware('loggedin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('login', [AuthController::class, 'login'])->name('login_process');
    Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
    Route::post('register', [AuthController::class, 'register'])->name('register_process');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [PageController::class, 'dashboard_user'])->name('user_dashboard');
    Route::get('profil', [PageController::class, 'profil_user'])->name('profil_user');
    Route::get('/profil/edit/{id}', [PageController::class, 'profil_edit']);
    Route::post('/process/edit/profil', [PageController::class, 'profil_process']);
    Route::get('/laporan', [PageController::class, 'laporan'])->name('laporan_keuangan');
    Route::get('/klaim/form', [PageController::class, 'klaim_form'])->name('form_klaim');
    Route::get('/form/klaim/baru', [PageController::class, 'form_klaim']);
    Route::get('/form/klaim/hapus/{id}', [PageController::class, 'hapus_klaim']);
    
    Route::post('/klaim/process', [PageController::class, 'klaim_proses']);
    

    // ADMIN ROUTE (START)
    Route::get('/admin', [AdminController::class, 'home'])->name('admin_dashboard');
    Route::get('/admin/pemasukan', [AdminController::class, 'pemasukan'])->name('pemasukan');
    Route::get('/admin/pemasukan/{id}', [AdminController::class, 'pemasukan_anggota']);
    Route::get('/admin/pemasukan/{id}/form', [AdminController::class, 'form_pemasukan']);
    Route::post('/admin/pemasukan/process', [AdminController::class, 'proses_pemasukan']);
    Route::get('/admin/pemasukan/{id}/delete/{id_anggota}', [AdminController::class, 'hapus_pemasukan']);
    Route::get('/admin/pemasukan/{id}/edit/{id_anggota}', [AdminController::class, 'edit_pemasukan']);
    Route::post('/admin/pemasukan/update', [AdminController::class, 'update_pemasukan']);
    
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('/admin/laporan/form', [AdminController::class, 'form_laporan']);
    Route::post('/admin/laporan/process', [AdminController::class, 'process_laporan']);
    Route::get('/admin/laporan/{id}/edit', [AdminController::class, 'edit_laporan']);
    Route::post('/admin/laporan/update', [AdminController::class, 'update_laporan']);
    Route::get('/admin/laporan/{id}/delete', [AdminController::class, 'delete_laporan']);
    
    Route::get('/admin/add/investor', [AdminController::class, 'form_investor'])->name('tambah_investor');
    Route::post('/admin/investor/process', [AdminController::class, 'add_investor']);
    Route::get('/admin/investor/{id}/delete', [AdminController::class, 'delete_investor']);
    Route::get('/admin/klaim/dana', [AdminController::class, 'klaim_riwayat'])->name('klaim_dana');
    Route::get('/admin/klaim/{id}', [AdminController::class, 'konfirmasi_klaim']);
    Route::get('/admin/investor/{id}', [AdminController::class, 'investor_profil']);
    Route::get('/admin/point', [AdminController::class, 'point'])->name('point');
    
    Route::get('/admin/point/update/{id}', [AdminController::class, 'point_update']);
    
    Route::post('/admin/point/process', [AdminController::class, 'point_process']);
    Route::get('/admin/email', [PemasukanEmailController::class, 'index']);
    
    // END
    Route::get('admin/clear/cache', function(){
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        return("Cache clear successfull");

    });
});
