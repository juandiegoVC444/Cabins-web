<?php

use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;

Route::get('seasons/{id}/disable', [App\Http\Controllers\SeasonsController::class, 'disableSeasons'])->name('seasons.disableSeasons');
Route::get('seasons/{id}/active', [App\Http\Controllers\SeasonsController::class, 'activeSeasons'])->name('seasons.activeSeasons');
Route::get('seasons/showDetail/{id}',[App\Http\Controllers\SeasonsController::class,'showDetail']) ->name('seasons.showDetail');
Route::resource('season', SeasonsController::class)->names('seasons');
