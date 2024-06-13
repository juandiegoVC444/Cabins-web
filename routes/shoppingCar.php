<?php

use App\Http\Controllers\ShoppingCarController;
use Illuminate\Support\Facades\Route;

Route::get('shoppingCar',[shoppingCarController::class,'index']) ->name("shoppingCar.index");
Route::get('shoppingCar/delete',[ShoppingCarController::class,'delete']) ->name("shoppingCar.delete");

Route::get('shoppingCar/{id}/edit/{cantidad}',[shoppingCarController::class, 'edit'])->name('shoppingCar.edit');
Route::get('shoppingCar/{product}/create',[shoppingCarController::class,'create']) ->name("shoppingCar.create");
Route::get('shoppingCar/{product}/clearProduct',[shoppingCarController::class,'clearProduct']) ->name("shoppingCar.clearProduct");

//servicios
Route::get('shoppingCar/{id}/{ninos}/{adultos}/{fecha_inicial}/{fecha_final}/createServices',[shoppingCarController::class,'createServices']) ->name("shoppingCar.createservice");
Route::get('shoppingCar/{id}/editServicesA/{cantidad}',[shoppingCarController::class, 'editServicesA'])->name('shoppingCar.editServicesA');
Route::get('shoppingCar/{id}/editServicesN/{cantidad}',[shoppingCarController::class, 'editServicesN'])->name('shoppingCar.editServicesN');
