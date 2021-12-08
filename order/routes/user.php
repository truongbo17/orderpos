<?php

use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::prefix('user')->middleware(['auth', 'permission:admin'])->group(function () {
    Route::get('/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/postadd', [UserController::class, 'postAdd'])->name('user.postadd');
    Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/postedit', [UserController::class, 'postEdit'])->name('user.postedit');
    Route::post('/updateword', [UserController::class, 'updateStatusWorkBack'])->name('user.workback');
});
Route::get('/', [UserController::class, 'index'])->middleware(['auth'])->name('user.index');

Route::get('profile', [UserController::class, 'profile'])->middleware(['auth'])->name('user.profile');
Route::get('profile/edit', [UserController::class, 'profileEdit'])->middleware(['auth'])->name('user.profileedit');
Route::post('profile/postedit', [UserController::class, 'postProfileEdit'])->middleware(['auth'])->name('user.posteditprofile');


Route::get('logout', function () {
    $id = Auth::user()->id;
    User::where('id', $id)->update(['status' => 0]);
    Auth::logout();
    return redirect()->route('login');
})->middleware(['auth'])->name('user.logout');
