<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PqrsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use Illuminate\Http\Request;
use App\Models\Bookings;

Route::get('/', function () {
    return view('/customers/home/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user-info', [UserController::class, 'userInfo'])->name('users.userInfo');

Route::post('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('products/{product}/show',[App\Http\Controllers\ProductsController::class,'details']) ->name("products.show");
Route::get('products/productsviews',[App\Http\Controllers\ProductsController::class,'productsviews']) ->name("products.productsviews");
Route::get('services/servicesviews',[App\Http\Controllers\ServicesController::class,'servicesviews']) ->name("services.servicesviews");
Route::get('products/{product}/showviews',[App\Http\Controllers\ProductsController::class,'productDetails']) ->name("products.showviews");

include 'users.php';

Route::group(['middleware' => ['auth', 'checkRole:1']], function () {

//RUTAS USUARIOS - CAMBIO DE CONTRASEÑA

//RUTAS PRODUCTOS
Route::get('products/{id}/desactivar', [ProductsController::class, 'disableProducts'])->name('products.disableProducts');
Route::get('products/{id}/activar', [ProductsController::class, 'activeProducts'])->name('products.activeProducts');
Route::post('/products/{products}', [ProductsController::class, 'update'])->name('products.update');
Route::resource('/products', ProductsController::class)->names('products');

//RUTAS PQRS

Route::get('/pqrs', [App\Http\Controllers\PqrsController::class, 'index'])->name('pqrs.index');
Route::get('/pqrs/{pqr}/update', [PqrsController::class, 'show'])->name('pqrs.update');

// RUTAS SERVICIOS

//Rutas Servicios
Route::get('services/{id}/disable', [App\Http\Controllers\ServicesController::class, 'disableServices'])->name('services.disableServices');
Route::get('services/{id}/active', [App\Http\Controllers\ServicesController::class, 'activeServices'])->name('services.activeServices');
Route::resource('/services', ServicesController::class)->names('services');
// Route::get('services/servicesviews',[App\Http\Controllers\ServicesController::class,'servicesviews']) ->name("services.servicesviews");
// Route::get('services/{service}/servicesdetails',[App\Http\Controllers\ServicesController::class,'detailservices']) ->name("services.detailservices");


//Rutas de la tabla detalles servicios
Route::get('services/{services}/addDetail',[App\Http\Controllers\ServicesController::class,'addDetail']) ->name("services.addDetail");
Route::post('services/{services}/createDetail',[App\Http\Controllers\ServicesController::class,'createDetail']) ->name("services.createDetail")
->middleware('auth');
Route::get('services/{services}/showDetails', [App\Http\Controllers\ServicesController::class, 'showDetails'])->name('services.showDetails');
Route::get('services/detailEdit/{id}/{de}',[App\Http\Controllers\ServicesController::class,'detailEdit']) ->name("services.detailEdit");
Route::get('/services/detailUpdate/{id}/{de}', [App\Http\Controllers\ServicesController::class, 'detailUpdate'])->name('services.detailUpdate');
Route::get('services/{id}/disabledetail', [App\Http\Controllers\ServicesController::class, 'disableDetailServices'])->name('services.disableDetailServices');
Route::get('services/{id}/activedetail', [App\Http\Controllers\ServicesController::class, 'activeDetailServices'])->name('services.activeDetailServices');

//Rutas tabla Resources Imagenes
Route::get('services/addImage/{id}/{de}',[App\Http\Controllers\ServicesController::class,'addImage']) ->name("services.addImage");
Route::post('services/storeImage/{id}/{de}',[App\Http\Controllers\ServicesController::class,'storeImage']) ->name("services.storeImage");
Route::get('services/editImg/{id}/{im}/{de}',[App\Http\Controllers\ServicesController::class,'editImg']) ->name("services.editImg");
Route::get('services/captureImg/{id}/{de}',[App\Http\Controllers\ServicesController::class,'captureImg']) ->name("services.captureImg");
Route::post('/services/updateImg/{id}/{im}/{de}', [App\Http\Controllers\ServicesController::class, 'updateImg'])->name('services.updateImg');
Route::get('/services/oldImg/{id}/{de}', [App\Http\Controllers\ServicesController::class, 'oldImg'])->name('services.oldImg');
Route::get('services/{id}/activeimg', [App\Http\Controllers\ServicesController::class, 'activeImg'])->name('services.activeImg');
Route::get('services/{id}/disableimg', [App\Http\Controllers\ServicesController::class, 'disableImg'])->name('services.disableImg');

//RUTAS RESERVAS

Route::get('/bookings/{book}', [App\Http\Controllers\BookingsController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{booking}/delete', [App\Http\Controllers\BookingsController::class, 'destroy'])->name('bookings.delete');

Route::get('/bookings', [App\Http\Controllers\BookingsController::class, 'index'])->name('bookings.index');
Route::put('/bookings/{booking}/update', [App\Http\Controllers\BookingsController::class, 'update'])->name('bookings.update');


});

Route::get('/bookings/create/{id}', [App\Http\Controllers\BookingsController::class, 'create'])->name('bookings.create');

//RUTAS CONTACTANOS
Route::view('/contact', '/customers/contact/contact');


//RUTAS PQRS

Route::put('/pqrs/{id}/delete', [PqrsController::class, 'delete'])->name('pqrs.delete');
Route::put('/pqrs/{id}/update', [PqrsController::class, 'update'])->name('pqrs.update');
Route::put('/pqrs/{id}/disableProducts', [PqrsController::class, 'disableProducts'])->name('pqrs.disableProducts');

Route::post('/pqrs/store', [App\Http\Controllers\PqrsController::class, 'store'])->name('pqrs.store');
Route::get('/pqrs/create', [PqrsController::class, 'create'])->name('pqrs.create');

//Route::post('/bookings/success', [App\Http\Controllers\BookingsController::class, 'newEvent'])->name('bookings.newEvent');

Route::get('services/servicesviews',[App\Http\Controllers\ServicesController::class,'servicesviews']) ->name("services.servicesviews");
Route::get('services/{service}/servicesdetails',[App\Http\Controllers\ServicesController::class,'detailservices']) ->name("services.detailservices");


//RUTAS REGISTER
Route::get('register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register');

//RUTAS CARRITO DE COMPRAS

include 'shoppingCar.php';

//RUTAS TEMPORADAS

include 'season.php';

//RUTA FACTURA
Route::get('bills/{idBook}', [App\Http\Controllers\BookingsController::class, 'billsGetDates'])->name('bills.billsGetDates');
