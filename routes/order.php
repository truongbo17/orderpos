<?php

use App\Http\Controllers\Order\TablesController;
use App\Http\Controllers\LiveSearch\LiveSearchController;

Route::prefix('order')->middleware(['auth'])->group(function () {
    Route::get('tables', [TablesController::class, 'index'])->name('tables.index');
    Route::post('getproduct', [TablesController::class, 'getProduct'])->name('tables.getproduct');
    Route::post('livesearchtable', [LiveSearchController::class, 'livesearchtable'])->name('tables.livesearchtable');
    Route::post('livesearchproduct', [LiveSearchController::class, 'livesearchproduct'])->name('tables.livesearchproduct');
});
