<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::prefix('v1')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('cursos/average-rating', [CursoController::class, 'averageRating']);
    Route::get('cursos/instructores', [CursoController::class, 'instructores']);
    Route::get('cursos/instructores/all', [CursoController::class, 'instructoresAll']);

    Route::get('cursos/{curso}', [CursoController::class, 'show'])->whereNumber('curso');
    Route::put('cursos/{curso}', [CursoController::class, 'update']);
    Route::delete('cursos/{curso}', [CursoController::class, 'destroy']);
    Route::apiResource('cursos', CursoController::class);
});




