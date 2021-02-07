<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group([
    'prefix' => 'user', 
    'middleware' => 'auth:api'
], function () {
    Route::get('/', [AuthController::class, 'user'])->middleware(['scope:usuario,administrador']);
    Route::get('/image', [AuthController::class, 'profile'])->middleware(['scope:usuario,administrador']);
    Route::post('update', [AuthController::class, 'update'])->middleware(['scope:usuario,administrador']);;
});

Route::group([
    'prefix' => 'image', 
    'middleware' => 'auth:api'
], function () {
    Route::post('/', [ImageController::class, 'save'])->middleware(['scope:administrador']);
    Route::delete('/{id}', [ImageController::class, 'apagar'])->middleware(['scope:administrador']);

    Route::get('/', [ImageController::class, 'list'])->middleware(['scope:usuario,administrador']);
    Route::get('/{id}', [ImageController::class, 'consultar'])->middleware(['scope:usuario,administrador']);
    Route::get('/{id}/download', [ImageController::class, 'download'])->middleware(['scope:usuario,administrador']);
    ;
});