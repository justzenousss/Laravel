<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/product-image/{path}', function ($path) {
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $fullPath = storage_path('app/public/' . $path);

    return response()->file($fullPath);
})->where('path', '.*')->name('product.image');

Route::resource('products', ProductController::class);