<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('cursos/instructores', [CursoController::class, 'instructores']);
Route::get('cursos/instructores/all', [CursoController::class, 'instructoresAll']);
Route::apiResource('cursos', CursoController::class);

