<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/text',function(){
    return view('text');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::resource('admin-dc', AdminUsersController::class);

// Route::resource('admin-dc-dpt', App\Http\Controllers\Departmentcontroller::class);

// Route::resource('admin-dc-dist', App\Http\Controllers\DistrictController::class);


// Admin -> Doctor
Route::middleware(['auth','admin'])->prefix('admin-dc')->name('admin-dc.')->group(function(){
    // Route::resource('/', AdminUsersController::class);
    Route::resource('/', App\Http\Controllers\AdminDoctorController::class);
    Route::resource('dpt', App\Http\Controllers\Departmentcontroller::class);
    Route::resource('dist', App\Http\Controllers\DistrictController::class);
});

//Doctors only
Route::resource('dc', App\Http\Controllers\DoctorController::class)->middleware('doctor');

//Staff only
Route::resource('st', App\Http\Controllers\StaffController::class)->middleware('staff');

// Admin -> Staff
Route::resource('admin-st', App\Http\Controllers\AdminStaffController::class)->middleware('auth');

// Admin Only + Admin -> admin
Route::resource('admin-ad', App\Http\Controllers\AdminUsersController::class)->middleware('auth');




