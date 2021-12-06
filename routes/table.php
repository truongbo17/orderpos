<?php

use App\Http\Controllers\Table\TableController;

Route::prefix('table')->middleware(['auth'])->group(function () {
    Route::get('/', [TableController::class, 'index'])->name('table.index');
    Route::post('add', [TableController::class, 'add'])->middleware(['permission:admin'])->name('table.add');
    Route::post('getinfo', [TableController::class, 'getinfo'])->middleware(['permission:admin'])->name('table.getinfo');
    Route::post('delete', [TableController::class, 'delete'])->middleware(['permission:admin'])->name('table.delete');
});
