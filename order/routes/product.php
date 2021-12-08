<?php

use App\Http\Controllers\Product\ProductController;

Route::prefix('product')->middleware(['auth'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::post('addProduct', [ProductController::class, 'add'])->middleware(['permission:admin'])->name('product.addproduct');
    Route::post('getinfoproduct', [ProductController::class, 'getinfoproduct'])->middleware(['permission:admin'])->name('product.getinfoproduct');
    Route::post('deleteproduct', [ProductController::class, 'deleteproduct'])->middleware(['permission:admin'])->name('product.deleteproduct');
});
