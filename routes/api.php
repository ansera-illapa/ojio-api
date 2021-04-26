<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Para todas las funcoiones de modo estandar
// Route::resource('productos', ProductoController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//   });

// Rutas publicas 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::get('/productos/search/{nombre}', [ProductoController::class, 'search']);

// Rutas Protegidas
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
