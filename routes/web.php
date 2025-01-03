<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KompenController;
use App\Http\Controllers\JenisTugasController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\DataMahasiswaController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);
// Keep this route to point to the WelcomeController
Route::get('/welcome', [WelcomeController::class, 'index']);
// Route::resource('level', LevelController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // Menampilkan profil
    Route::get('/profile/update', [ProfileController::class, 'showUpdateProfileForm'])->name('profile.update'); // Form update profile
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update.store'); // Proses update profile

    Route::get('/profile/update/images', [ProfileController::class, 'showUpdateImagesForm'])->name('profile.update.images'); // Form upload foto
    Route::post('/profile/update/images', [ProfileController::class, 'updateImages'])->name('profile.update.images.store'); // Proses update foto
});
Route::group(['prefix' => 'user', 'middleware'=>'authorize:ADM'], function() {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam json untuk datables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class,'store']);          // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menampilkan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user

    // Rute untuk import mahasiswa
    Route::post('/import/mahasiswa', [UserController::class, 'importMahasiswa']);
    // Rute untuk import dosen/tendik
    Route::post('/import/dosen-tendik', [UserController::class, 'importDosenTendik']);
});


Route::group(['prefix' => 'level', 'middleware'=>'authorize:ADM'], function() {
    Route::get('/', [LevelController::class, 'index']);             
    Route::post('/list', [LevelController::class, 'list']);         
    Route::get('/create', [LevelController::class, 'create']);      
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); 
    Route::post('/ajax', [LevelController::class, 'store_ajax']); 
    Route::post('/', [LevelController::class, 'store']);             
    Route::get('/{id}', [LevelController::class, 'show']);         
    Route::get('/{id}/edit', [LevelController::class, 'edit']);    
    Route::put('/{id}', [LevelController::class, 'update']);      
    Route::delete('/{id}', [LevelController::class, 'destroy']);   
});


Route::group(['prefix' => 'kompen', 'middleware'=>'authorize:ADM,DSN,TDK'], function() {
    Route::get('/', [KompenController::class, 'index']);          // Menampilkan halaman awal kompen
    Route::post('/list', [KompenController::class, 'list']);      // Menampilkan data kompen dalam json untuk datatables
    Route::get('/create', [KompenController::class, 'create']);   // Menampilkan halaman form tambah kompen
    Route::post('/', [KompenController::class, 'store']);         // Menyimpan data kompen baru
    Route::get('/create_ajax', [KompenController::class, 'create_ajax']); // Menampilkan halaman form tambah kompen Ajax
    Route::post('/ajax', [KompenController::class, 'store_ajax']); // Menyimpan data kompen baru via Ajax
    Route::get('/{uuid}', [KompenController::class, 'show']);       // Menampilkan detail kompen
    Route::get('/{id}/show_ajax', [KompenController::class, 'show_ajax']); // Menampilkan detail kompen via Ajax
    Route::get('/{uuid}/edit', [KompenController::class, 'edit']);  // Menampilkan halaman form edit kompen
    Route::put('/{uuid}', [KompenController::class, 'update']);     // Menyimpan perubahan data kompen
    Route::delete('/{uuid}', [KompenController::class, 'destroy']); // Menghapus data kompen
});
Route::group(['prefix' => 'jenistugas', 'middleware' => 'authorize:ADM'], function() {
    Route::get('/', [JenisTugasController::class, 'index']);             
    Route::post('/list', [JenisTugasController::class, 'list']);         
    Route::get('/create', [JenisTugasController::class, 'create']);      
    Route::get('/create_ajax', [JenisTugasController::class, 'create_ajax']); 
    Route::post('/ajax', [JenisTugasController::class, 'store_ajax']); 
    Route::post('/', [JenisTugasController::class, 'store']);             
    Route::get('/{id}', [JenisTugasController::class, 'show']);         
    Route::get('/{id}/edit', [JenisTugasController::class, 'edit']);    
    Route::put('/{id}', [JenisTugasController::class, 'update']);      
    Route::delete('/{id}', [JenisTugasController::class, 'destroy']);   
});
Route::group(['prefix' => 'kompetensi', 'middleware' => 'authorize:ADM'], function() {
    Route::get('/', [KompetensiController::class, 'index']);             
    Route::post('/list', [KompetensiController::class, 'list']);         
    Route::get('/create', [KompetensiController::class, 'create']);      
    Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']); 
    Route::post('/ajax', [KompetensiController::class, 'store_ajax']); 
    Route::post('/', [KompetensiController::class, 'store']);             
    Route::get('/{id}', [KompetensiController::class, 'show']);         
    Route::get('/{id}/edit', [KompetensiController::class, 'edit']);    
    Route::put('/{id}', [KompetensiController::class, 'update']);      
    Route::delete('/{id}', [KompetensiController::class, 'destroy']);   
});


Route::group(['prefix' => 'datamahasiswa', 'middleware' => 'authorize:ADM,DSN,TDK'], function() {
    Route::get('/', [DataMahasiswaController::class, 'index']);             
    Route::post('/list', [DataMahasiswaController::class, 'list']);         
    Route::get('/create', [DataMahasiswaController::class, 'create']);      
    Route::post('/', [DataMahasiswaController::class, 'store']);             
    Route::get('/{id_alpha}', [DataMahasiswaController::class, 'show']);         
    Route::get('/{id_alpha}/edit', [DataMahasiswaController::class, 'edit']);    
    Route::put('/{id_alpha}', [DataMahasiswaController::class, 'update']);      
    Route::delete('/{id_alpha}', [DataMahasiswaController::class, 'destroy']);   
    Route::post('/import_ajax', [DataMahasiswaController::class, 'import_ajax']);
    Route::get('/export/excel', [DataMahasiswaController::class, 'export_excel'])->name('datamahasiswa.export.excel');
    Route::get('/export/pdf', [DataMahasiswaController::class, 'export_pdf'])->name('datamahasiswa.export.pdf');
    
});

use App\Http\Controllers\MhsKompenController;

Route::prefix('mhskompen')->group(function () {
    Route::get('/', [MhsKompenController::class, 'index'])->name('mhskompen.index');
    Route::get('/list', [MhsKompenController::class, 'list'])->name('mhskompen.list');
    Route::get('/{UUID_Kompen}', [MhsKompenController::class, 'show'])->name('mhskompen.show');
    Route::post('/', [MhsKompenController::class, 'store'])->name('mhskompen.store');
    Route::get('/mhskompen/{UUID_Kompen}/create', [MhsKompenController::class, 'create'])->name('mhskompen.create');
    Route::post('/mhskompen', [MhsKompenController::class, 'store'])->name('mhskompen.store');
    Route::get('/create-ajax/{UUID_Kompen}', [MhsKompenController::class, 'create_ajax'])->name('mhskompen.create-ajax');
    Route::post('/store-ajax', [MhsKompenController::class, 'store_ajax'])->name('mhskompen.store-ajax');
});
use App\Http\Controllers\ProgressMhsController;
Route::prefix('progressmhs')->group(function () {
    Route::get('/', [ProgressMhsController::class, 'index'])->name('progressmhs.index');
    Route::get('/list/{ni}', [ProgressMhsController::class, 'list'])->name('progressmhs.list');
    Route::get('/show-ajax/{id}', [ProgressMhsController::class, 'showAjaxReq'])->name('progressmhs.show-ajax');
    Route::get('/create-bukti/{uuidKompen}', [ProgressMhsController::class, 'createBukti'])->name('progressmhs.create-bukti');
    Route::post('/upload-bukti', [ProgressMhsController::class, 'uploadBukti'])->name('progressmhs.upload-bukti');
    Route::get('/view-bukti/{uuidKompen}', [ProgressMhsController::class, 'viewBukti'])->name('progressmhs.view-bukti');
    Route::get('/download-bukti/{uuidKompen}', [ProgressMhsController::class, 'downloadBukti'])->name('progressmhs.download-bukti');
});
use App\Http\Controllers\PengajuanKompenController;

Route::prefix('pengajuankompen')->group(function () {
    Route::get('/', [PengajuanKompenController::class, 'index'])->name('pengajuankompen.index');
    
    Route::get('/list', [PengajuanKompenController::class, 'list'])->name('pengajuankompen.list');
    
    Route::get('/requests/{uuidKompen}', [PengajuanKompenController::class, 'getKompenRequestByUuid'])->name('pengajuankompen.requests');
    Route::post('/update_status', [PengajuanKompenController::class, 'updateStatus'])->name('pengajuankompen.update_status');
    Route::post('/delete_request', [PengajuanKompenController::class, 'deleteRequest'])->name('pengajuankompen.delete_request');
    
});
use App\Http\Controllers\ProgressKompenController;

    // Rute untuk menampilkan halaman awal kompen
    Route::get('/progresskompen', [ProgressKompenController::class, 'index'])->name('progresskompen.index');
    // Rute untuk mengambil data kompen dalam bentuk JSON untuk DataTables
    Route::get('/progresskompen/list', [ProgressKompenController::class, 'list'])->name('progresskompen.list');
    // Rute untuk mengupdate bukti
    Route::post('/progresskompen/update-bukti', [ProgressKompenController::class, 'updateBukti'])->name('progresskompen.update_bukti');
    // Rute untuk melihat bukti berdasarkan UUID_Kompen
    Route::get('/progresskompen/view-bukti/{uuidKompen}', [ProgressKompenController::class, 'viewBukti'])->name('progresskompen.view_bukti');
    // Rute untuk menyelesaikan kompen berdasarkan UUID_Kompen
    Route::post('/progresskompen/selesaikan/{uuidKompen}', [ProgressKompenController::class, 'selesaikanKompen'])->name('progresskompen.selesaikan');
    // Rute untuk menampilkan detail bukti berdasarkan UUID_Kompen
    Route::get('/progresskompen/detail-bukti/{uuidKompen}', [ProgressKompenController::class, 'showDetailBukti'])->name('progresskompen.detail_bukti');
    // Rute untuk mendownload bukti berdasarkan UUID_Kompen dan id_progres
    Route::get('/progresskompen/download-bukti/{uuidKompen}', [ProgressKompenController::class, 'showDownloadBukti'])->name('progresskompen.download_bukti');
    Route::get('/progresskompen/{uuidKompen}/show', [ProgressKompenController::class, 'show'])->name('progresskompen.show');

use App\Http\Controllers\HistoryKompenController;


Route::prefix('history-kompen')->group(function () {
    // Halaman utama riwayat kompensasi
    Route::get('/', [HistoryKompenController::class, 'index'])->name('history.index');
    // API untuk DataTables (list riwayat kompensasi)
    Route::get('/list', [HistoryKompenController::class, 'list'])->name('history.list');
    // Route untuk menampilkan detail kompen
    Route::get('/{UUID_Kompen}', [HistoryKompenController::class, 'show'])->name('history.show');
});


use App\Http\Controllers\HistoryMhsController;

Route::get('/historymhs', [HistoryMhsController::class, 'indexMhs'])->name('historymhs.index');
Route::get('/historykompenmhs', [HistoryMhsController::class, 'historyKompenMhs'])->name('historymhs.kompen');
Route::get('/historymhs/export-pdf/{UUID_Kompen}', [HistoryMhsController::class, 'exportPdf'])->name('historymhs.exportPdf');
Route::get('/historymhs/{UUID_Kompen}', [HistoryMhsController::class, 'show'])->name('historymhs.show');
