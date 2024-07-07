<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\FeaturedCarsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ServicesController;
use App\Http\Controllers\frontend\AppointmentController;
use App\Http\Controllers\frontend\BrandsController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.client');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('admin.client.edit');
    Route::any('/clients/destroy/{id}', [ClientController::class, 'destroy'])->name('admin.client.destroy');
    Route::get('/featured-cars', [CarController::class, 'index'])->name('admin.cars');
    Route::get('/featured-cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/featured-cars/store', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('/featured-cars/edit/{id}', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/featured-cars/update/{id}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::any('/featured-cars/destroy/{id}', [CarController::class, 'destroy'])->name('admin.cars.destroy');
    Route::get('/brands', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brands');
    Route::get('/brands/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/brands/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brands.store');
    Route::any('/brands/destroy/{id}', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('admin.brands.destroy');
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout.admin');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/appointment', [AppointmentController::class, 'index']);
    Route::post('/appointment/store', [AppointmentController::class, 'store']);
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/services', [ServicesController::class, 'index'])->name('frontend.service');
Route::get('/brands', [BrandsController::class, 'index'])->name('frontend.brands');
Route::get('/featured_cars', [FeaturedCarsController::class, 'index'])->name('frontend.featured_cars');
Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.page');
Route::post('/login-process', [LoginController::class, 'login'])->name('login');
