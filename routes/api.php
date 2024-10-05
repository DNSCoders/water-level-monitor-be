<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DamController;
use App\Http\Controllers\POBController;
use App\Http\Controllers\DebitReportController;
use App\Http\Controllers\AuthController;

// Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

Route::get('dams', [DamController::class, 'index']);
Route::get('dams/{dam}', [DamController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('dams', DamController::class)->except(['index','show']); // Other dam routes still require auth
    Route::apiResource('pob', POBController::class);
    Route::apiResource('reports', DebitReportController::class);
});



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




