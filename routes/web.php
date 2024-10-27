<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportFileController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('export')->group(function () {
    Route::post('/dam', [ExportFileController::class, 'export_dam']);
    Route::post('/reports', [ExportFileController::class, 'export_report']);
});

