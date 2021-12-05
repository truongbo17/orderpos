<?php
use App\Http\Controllers\Salary\SalaryController;

Route::prefix('salary')->middleware(['auth'])->group(function () {
    Route::get('/', [SalaryController::class, 'index'])->name('salary.index');
});
