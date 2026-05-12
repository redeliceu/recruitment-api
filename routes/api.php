<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\VacancyController;

Route::post('/upload', [UploadController::class, 'upload']);
Route::delete('/upload', [UploadController::class, 'delete']);

Route::post('/application', [JobApplicationController::class, 'store']);
Route::patch('/application/{id}/status', [JobApplicationController::class, 'updateStatus']);

Route::get('/applications', [JobApplicationController::class, 'getAll']);

Route::post('/vacancy', [VacancyController::class, 'store']);
Route::put('/vacancy/{id}', [VacancyController::class, 'update']);
Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy']);
Route::get('/vacancies', [VacancyController::class, 'index']);
Route::get('/vacancy/metadata', [VacancyController::class, 'metadata']);

Route::post('/applications/cvs', [JobApplicationController::class, 'exportCvsInZip']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
