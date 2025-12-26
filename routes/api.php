<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('cursos')->group(function () {
    Route::get('average-rating', [CursoController::class, 'averageRating']);
    Route::get('instructores', [CursoController::class, 'instructores']);
    Route::get('instructores/all', [CursoController::class, 'instructoresAll']);
    Route::get('{curso}', [CursoController::class, 'show']);
});

Route::apiResource('cursos', CursoController::class);

