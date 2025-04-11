<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/forms', [FormController::class, 'getForms']);
Route::get('/forms/{id}', [FormController::class, 'getForm']);
Route::post('/forms', [FormController::class, 'createForm']);
Route::put('/forms/{id}', [FormController::class, 'updateForm']);
Route::delete('/forms/{id}', [FormController::class, 'deleteForm']);
