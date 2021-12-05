<?php

use App\Http\Controllers\Order\TablesController;

Route::prefix('order')->middleware(['auth','permission:admin|user'])->group(function () {
    Route::get('tables', [TablesController::class, 'index'])->name('tables.index');
});
