<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);  
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);  

    Route::post('/tasks', [TaskController::class, 'store']); 
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);  
    Route::post('/tasks/{id}/status', [TaskController::class, 'updateStatus']);  

});

//Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
