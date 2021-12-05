<?php

use App\Http\Controllers\Category\CategoryController;

Route::prefix('category')->middleware(['auth', 'permission:admin'])->group(function () {
    Route::get('index', [CategoryController::class, 'index'])->name('category.index');
});
