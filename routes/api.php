<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DamController;
use App\Http\Controllers\POBController;
use App\Http\Controllers\DebitReportController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('dams', DamController::class);
Route::apiResource('pob', POBController::class);
Route::apiResource('reports', DebitReportController::class);

