<?php

use App\Http\Controllers\Customer\CustomerController;

Route::prefix('customer')->middleware(['auth'])->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('add', [CustomerController::class, 'add'])->middleware(['permission:admin'])->name('customer.add');
    Route::post('getinfo', [CustomerController::class, 'getinfo'])->middleware(['permission:admin'])->name('customer.getinfo');
    Route::post('delete', [CustomerController::class, 'delete'])->middleware(['permission:admin'])->name('customer.delete');
});
