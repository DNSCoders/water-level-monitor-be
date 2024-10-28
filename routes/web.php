<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportFileController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('export')->group(function () {
    Route::post('/dam', [ExportFileController::class, 'download_dam']);
    Route::post('/reports', [ExportFileController::class, 'download_report']);
    Route::get('/dam/preview', [ExportFileController::class, 'preview_dam']);
    Route::get('/reports/preview', [ExportFileController::class, 'preview_report']);
});

