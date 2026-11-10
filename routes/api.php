<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VacancyContextController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\ExitInterviewController;
use App\Http\Middleware\ApiKeyGuard;

/*
|--------------------------------------------------------------------------
| Rotas PÚBLICAS (site de vagas / formulários)
|--------------------------------------------------------------------------
*/
Route::post('/upload', [UploadController::class, 'upload']);
Route::post('/application', [JobApplicationController::class, 'store']);
Route::get('/vacancies', [VacancyController::class, 'index']);
Route::get('/vacancy/metadata', [VacancyController::class, 'metadata']);
Route::get('/vacancy-context', [VacancyContextController::class, 'index']);
Route::get('/vacancy-context/{id}', [VacancyContextController::class, 'show']);
Route::get('/schools', [SchoolsController::class, 'index']);
Route::get('/schools/{id}', [SchoolsController::class, 'show']);
Route::post('/exit-interviews', [ExitInterviewController::class, 'store']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

/*
|--------------------------------------------------------------------------
| Rotas ADMINISTRATIVAS — exigem chave (X-Api-Key ou Bearer)
| Fase 1: INTERNAL_API_KEY_ENFORCE=false só registra no log quem chama sem chave.
|--------------------------------------------------------------------------
*/
Route::middleware(ApiKeyGuard::class)->group(function () {
    Route::delete('/upload', [UploadController::class, 'delete']);

    Route::patch('/application/{id}/status', [JobApplicationController::class, 'updateStatus']);
    Route::get('/applications', [JobApplicationController::class, 'getAll']);
    Route::post('/applications/cvs', [JobApplicationController::class, 'exportCvsInZip']);

    Route::post('/vacancy', [VacancyController::class, 'store']);
    Route::put('/vacancy/{id}', [VacancyController::class, 'update']);
    Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy']);

    Route::post('/vacancy-context', [VacancyContextController::class, 'store']);
    Route::put('/vacancy-context/{id}', [VacancyContextController::class, 'update']);
    Route::delete('/vacancy-context/{id}', [VacancyContextController::class, 'destroy']);

    Route::get('/exit-interviews', [ExitInterviewController::class, 'index']);

    Route::post('/schools', [SchoolsController::class, 'store']);
    Route::put('/schools/{id}', [SchoolsController::class, 'update']);
    Route::delete('/schools/{id}', [SchoolsController::class, 'destroy']);
});
