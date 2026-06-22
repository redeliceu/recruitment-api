<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VacancyContextController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\ExitInterviewController;

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

// Rotas para Contexto de Vagas
Route::post('/vacancy-context', [VacancyContextController::class, 'store']);
Route::get('/vacancy-context', [VacancyContextController::class, 'index']);
Route::get('/vacancy-context/{id}', [VacancyContextController::class, 'show']);
Route::put('/vacancy-context/{id}', [VacancyContextController::class, 'update']);
Route::delete('/vacancy-context/{id}', [VacancyContextController::class, 'destroy']);

// Rotas para Exit Interviews
Route::post('/exit-interviews', [ExitInterviewController::class, 'store']);
Route::get('/exit-interviews', [ExitInterviewController::class, 'index']);

// Rotas para Escolas
Route::post('/schools', [SchoolsController::class, 'store']);
Route::get('/schools', [SchoolsController::class, 'index']);
Route::get('/schools/{id}', [SchoolsController::class, 'show']);
Route::put('/schools/{id}', [SchoolsController::class, 'update']);
Route::delete('/schools/{id}', [SchoolsController::class, 'destroy']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
