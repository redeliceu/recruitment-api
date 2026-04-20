<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JobApplicationController;

Route::post('/upload', [UploadController::class, 'upload']);
Route::delete('/upload', [UploadController::class, 'delete']);

Route::post('/application', [JobApplicationController::class, 'store']);

Route::get('/applications', [JobApplicationController::class, 'getAll']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
