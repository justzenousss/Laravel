<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MvcDemoController;

Route::get('/', [MvcDemoController::class, 'index']);