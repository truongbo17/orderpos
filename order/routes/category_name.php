<?php

use App\Http\Controllers\Category\CategoryController;

Route::prefix('category')->middleware(['auth'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('add', [CategoryController::class, 'add'])->middleware(['permission:admin'])->name('category.add');
    Route::post('viewproduct', [CategoryController::class, 'viewProduct'])->name('category.viewproduct');
    Route::post('addcategory', [CategoryController::class, 'addCategory'])->middleware(['permission:admin'])->name('category.addcategory');
    Route::post('editcategory', [CategoryController::class, 'editCategory'])->middleware(['permission:admin'])->name('category.editcategory');
    Route::post('deletecategory', [CategoryController::class, 'deleteCategory'])->middleware(['permission:admin'])->name('category.deletecategory');
});
