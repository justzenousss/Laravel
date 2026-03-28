<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index']);
Route::get('/add', [StudentController::class, 'create']);
Route::post('/add', [StudentController::class, 'store']);
Route::get('/edit/{id}', [StudentController::class, 'edit']);
Route::post('/edit/{id}', [StudentController::class, 'update']);
Route::get('/delete/{id}', [StudentController::class, 'destroy']);