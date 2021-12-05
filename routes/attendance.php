<?php

use App\Http\Controllers\Attendance\AttendanceController;

Route::prefix('attendance')->middleware(['auth'])->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/add', [AttendanceController::class, 'add'])->middleware(['permission:admin'])->name('attendance.add');
    Route::get('/addatt', [AttendanceController::class, 'addatt'])->middleware(['permission:admin'])->name('attendance.addatt');
    Route::post('/postaddatt', [AttendanceController::class, 'postaddatt'])->middleware(['permission:admin'])->name('attendance.postadd');
    Route::post('/deleteAtt', [AttendanceController::class, 'deleteAtt'])->middleware(['permission:admin'])->name('attendance.deleteatt');
});
