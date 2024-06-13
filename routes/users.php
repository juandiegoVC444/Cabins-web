<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/activeUser', [UserController::class, 'activeUser'])->name('users.activeUser');
Route::get('users/{id}/disableUser', [UserController::class, 'disableUser'])->name('users.disableUser');
Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}/update1', [UserController::class, 'update1'])->name('users.update1');
Route::put('/users/{id}/myacount', [UserController::class, 'upMyacount'])->name('users.upMyacount');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('/users/create', [UserController::class, 'showCreate'])->name('users.showCreate');
Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/changePassword', [UserController::class, 'showPassword'])->name('users.showPassword');
Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'show'])->name('password.change');
Route::post('change-password',[App\Http\Controllers\ChangePasswordController::class, 'update'])->name('password.update');
// Route::resource('/users', UserController::class)->names('users');
