<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\EquipmentTypeController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/register', [AuthController::class, 'register'])->name('user.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('equipment', EquipmentController::class)->parameters([
        'equipment' => 'id'
    ]);

    Route::apiResource('equipment-type', EquipmentTypeController::class)->parameters([
        'equipment-type' => 'id'
    ]);

    Route::post('auth/logout', [AuthController::class, 'logout'])->name('user.logout');
});
