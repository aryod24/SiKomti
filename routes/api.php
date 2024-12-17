
<?php
use App\Http\Controllers\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KompenApiController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MahasiswaKompenApiController;
use App\Http\Controllers\Api\MahasiswaAlphaController;
use App\Http\Controllers\Api\ApplyApiController;
use App\Http\Controllers\Api\ApplyBuktiController;
use App\Http\Controllers\Api\HistoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();

});

Route::post('/logout', LogoutController::class)->middleware('auth:api');


Route::prefix('kompen')->group(function () {
    Route::get('/', [KompenApiController::class, 'index']);               // GET: /api/kompen - Mendapatkan daftar kompen
    Route::get('/{UUID_Kompen}', [KompenApiController::class, 'show']);   // GET: /api/kompen/{UUID_Kompen} - Mendapatkan detail kompen
    Route::post('/', [KompenApiController::class, 'store']);              // POST: /api/kompen - Menyimpan data kompen baru
    Route::put('/{UUID_Kompen}', [KompenApiController::class, 'update']); // PUT: /api/kompen/{UUID_Kompen} - Memperbarui data kompen
    Route::delete('/{UUID_Kompen}', [KompenApiController::class, 'destroy']); // DELETE: /api/kompen/{UUID_Kompen} - Menghapus data kompen
});

<<<<<<< HEAD
=======
Route::get('/kompetensi', [KompenApiController::class, 'getKompetensi']);        // GET: /api/kompetensi - Mendapatkan data kompetensi
Route::get('/jenis-tugas', [KompenApiController::class, 'getJenisTugas']);       // GET: /api/jenis-tugas - Mendapatkan data jenis tugas

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

Route::group(['prefix'=>'users'], function(){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

<<<<<<< HEAD
=======
Route::get('levels', [UserController::class, 'getLevels']);


>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

    // Route for creating a kompen request
    Route::post('/kompen/request', [MahasiswaKompenApiController::class, 'createKompenRequest']);

    // Route for updating the status of a kompen request
    Route::put('/kompen/update-status/{id}', [MahasiswaKompenApiController::class, 'updateStatusAcc']);
// Add this route to api.php
Route::get('check-request', [MahasiswaKompenApiController::class, 'checkExistingRequest']);

    // Route for getting all kompen requests for a specific NI
    Route::get('/kompen/requests/{ni}', [MahasiswaKompenApiController::class, 'getKompenRequests']);

    // Route for getting a kompen request by UUID_Kompen and user_id
    Route::get('/kompen/request/{uuidKompen}', [MahasiswaKompenApiController::class, 'getKompenRequestByUuid']);

    // Route for getting all kompen requests
    Route::get('/requests', [MahasiswaKompenApiController::class, 'getAllKompenRequests']);

Route::put('/update-status', [ApplyApiController::class, 'updateStatus']);
Route::delete('/delete-request', [ApplyApiController::class, 'deleteRequest']);


Route::put('/update-bukti', [ApplyBuktiController::class, 'updateBukti']);
Route::delete('/delete-request', [ApplyBuktiController::class, 'deleteRequest']);
Route::get('/view-bukti/{uuidKompen}', [ApplyBuktiController::class, 'viewBukti']);
Route::put('/selesaikanKompen/{uuidKompen}', [ApplyBuktiController::class, 'selesaikanKompen']);
Route::get('/view-progress-kompen/{ni}', [ApplyBuktiController::class, 'viewProgressKompen']);
// Route for uploading bukti
Route::post('/upload-bukti', [ApplyBuktiController::class, 'uploadBukti'])->name('uploadBukti');
Route::get('/show-detail-bukti/{uuidKompen}', [ApplyBuktiController::class, 'showDetailBukti'])->name('showDetailBukti');
Route::get('/showdetail/{uuidKompen}/{idProgres}', [ApplyBuktiController::class, 'showDownloadBukti']);
Route::get('/history-kompen-dosen/{userId}', [HistoryController::class, 'historyKompenDosen']);
Route::get('/history-kompen-mhs/{ni}', [HistoryController::class, 'historyKompenMhs']);


Route::group(['prefix'=>'alpha'], function(){
        Route::get('/', [MahasiswaAlphaController::class, 'index']); // Get all mahasiswa alpha
        Route::post('/', [MahasiswaAlphaController::class, 'store']); // Create new mahasiswa alpha
        Route::get('/{mahasiswaAlpha}', [MahasiswaAlphaController::class, 'show']); // Get a specific mahasiswa alpha
        Route::get('/ni/{ni}', [MahasiswaAlphaController::class, 'showByNi']); // Get mahasiswa alpha by ni
        Route::put('/{mahasiswaAlpha}', [MahasiswaAlphaController::class, 'update']); // Update a specific mahasiswa alpha
        Route::delete('/{mahasiswaAlpha}', [MahasiswaAlphaController::class, 'destroy']); // Delete a specific mahasiswa alpha
    });
 