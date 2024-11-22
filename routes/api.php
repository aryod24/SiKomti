
<?php
use App\Http\Controllers\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KompenApiController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\MahasiswaKompenController;

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


Route::group(['prefix'=>'users'], function(){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::post('/kompen/request', [MahasiswaKompenController::class, 'createKompenRequest']);
Route::put('/kompen/status/{id}', [MahasiswaKompenController::class, 'updateStatusAcc']);


