<?php
use App\Http\Controllers\Salary\SalaryController;

Route::prefix('salary')->middleware(['auth'])->group(function () {
    Route::get('/', [SalaryController::class, 'index'])->name('salary.index');
    Route::post('submitSalary', [SalaryController::class, 'submitSalary'])->middleware('permission:admin')->name('salary.submitsalary');
    Route::post('submitPaySalary', [SalaryController::class, 'submitPaySalary'])->middleware('permission:admin')->name('salary.submitpaysalary');
});
