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
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);
// Keep this route to point to the WelcomeController
Route::get('/', [WelcomeController::class, 'index']);
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
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel',[usercontroller::class,'export_excel']); // ajax export excel
    Route::get('/export_pdf',[usercontroller::class,'export_pdf']); //ajax export pdf
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
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); 
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); 
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
    Route::get('/{id}/edit_ajax', [KompenController::class, 'edit_ajax']); // Menampilkan halaman form edit kompen via Ajax
    Route::put('/{id}/update_ajax', [KompenController::class, 'update_ajax']); // Menyimpan perubahan data kompen via Ajax
    Route::get('/{id}/delete_ajax', [KompenController::class, 'confirm_ajax']); // Tampilkan form konfirmasi hapus kompen via Ajax
    Route::delete('/{id}/delete_ajax', [KompenController::class, 'delete_ajax']); // Menghapus data kompen via Ajax
    Route::delete('/{uuid}', [KompenController::class, 'destroy']); // Menghapus data kompen
    Route::get('/import', [KompenController::class, 'import']); // Form untuk upload file excel
    Route::post('/import_ajax', [KompenController::class, 'import_ajax']); // Proses import file excel via Ajax
    Route::get('/export_excel', [KompenController::class, 'export_excel']); // Export data kompen ke Excel
    Route::get('/export_pdf', [KompenController::class, 'export_pdf']); // Export data kompen ke PDF
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
    Route::get('/{id}/edit_ajax', [JenisTugasController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [JenisTugasController::class, 'update_ajax']); 
    Route::get('/{id}/delete_ajax', [JenisTugasController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [JenisTugasController::class, 'delete_ajax']); 
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
    Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']); 
    Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete_ajax']); 
    Route::delete('/{id}', [KompetensiController::class, 'destroy']);   
});


Route::group(['prefix' => 'datamahasiswa', 'middleware' => 'authorize:ADM'], function() {
    Route::get('/', [DataMahasiswaController::class, 'index']);             
    Route::post('/list', [DataMahasiswaController::class, 'list']);         
    Route::get('/create', [DataMahasiswaController::class, 'create']);      
    Route::post('/', [DataMahasiswaController::class, 'store']);             
    Route::get('/{id_alpha}', [DataMahasiswaController::class, 'show']);         
    Route::get('/{id_alpha}/edit', [DataMahasiswaController::class, 'edit']);    
    Route::put('/{id_alpha}', [DataMahasiswaController::class, 'update']);      
    Route::delete('/{id_alpha}', [DataMahasiswaController::class, 'destroy']);   
});