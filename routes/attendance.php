<?php

use App\Http\Controllers\Attendance\AttendanceController;

Route::prefix('attendance')->middleware(['auth'])->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
});
