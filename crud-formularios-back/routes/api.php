<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/formularios', [FormController::class, 'getForms']);
Route::get('/formularios/{id}', [FormController::class, 'getForm']);
Route::post('/formularios', [FormController::class, 'createForm']);
Route::put('/formularios/{id}', [FormController::class, 'updateForm']);
Route::put('/formularios/{id}', [FormController::class, 'updateForm']);
Route::delete('/formularios/{id}', [FormController::class, 'deleteForm']);
