<?php

use App\Http\Controllers\Billing\BillingController;

Route::prefix('billing')->middleware(['auth'])->group(function () {
    Route::get('/', [BillingController::class, 'index'])->name('billing.index');
    Route::post('viewdetail', [BillingController::class, 'viewdetail'])->name('billing.viewdetail');
});
