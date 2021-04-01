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

// Admin + doctor -> Staff
Route::resource('admin-st', App\Http\Controllers\AdminStaffController::class)->middleware('admindoctor');

// Admin Only + Admin -> admin
Route::resource('admin-ad', App\Http\Controllers\AdminUsersController::class)->middleware('admin');


Route::get('admin-ad-li', [App\Http\Controllers\AdminUsersController::class, 'listadmin'])->middleware('admin')->name('admin-ad.li');



Route::resource('user', App\Http\Controllers\UserCommonController::class)->middleware('auth');

// Only doctor -> prescription
Route::resource('dc-pres', App\Http\Controllers\DoctorPrescriptionController::class)->middleware('doctor');



Route::middleware(['doctor'])->prefix('dc-pres')->name('dc-pres.')->group(function(){
    
    // Route::resource('/', App\Http\Controllers\DoctorPrescriptionController::class);
    Route::post('find', [App\Http\Controllers\DoctorPrescriptionController::class, 'findPatient']);
    Route::post('checkdata', [App\Http\Controllers\DoctorPrescriptionController::class, 'checkstore'])->name('checkdata');
    Route::post('post',[App\Http\Controllers\DoctorPrescriptionController::class,'ShowPrescriptionSystem'])->name('post');
    // Route::post('mypatientlist', [App\Http\Controllers\DoctorPrescriptionController::class, 'patientlist'])->name('patientlist');
});


// Index shows the doctor search 
Route::resource('patient', App\Http\Controllers\PatientMobBookingController::class)->middleware('auth');

Route::post('patient/makeAppointment', [App\Http\Controllers\PatientMobBookingController::class, 'makeAppointment'])->name('patient.makeAppointment');

Route::get('patient/appointments/{appointments}', [App\Http\Controllers\PatientMobBookingController::class, 'viewMyAppointments'])->name('patient.appointments');
// Route::get('doctor/')


// Patient appointments + Prescription 
Route::resource('patient-pres', App\Http\Controllers\PatientAppointmentPrescriptionController::class)->middleware('auth');

// Route::patch('patient-pres/updatePrivacy/{updatePrivacy}',[App\Http\Controllers\PatientAppointmentPrescriptionController::class,'updatePrivacy'])->name('patient.updatePrivacy')->middleware('auth');

Route::get('patient/prescriptionsList/{prescriptionsList}',[App\Http\Controllers\PatientAppointmentPrescriptionController::class,'prescriptionsList'])->name('patient.prescriptionsList')->middleware('auth');




// confusion here!!!
Route::post('doctor/search', [App\Http\Controllers\PatientMobBookingController::class, 'search'])->name('doctor.search');




Route::resource('dc-schedule', App\Http\Controllers\DoctorScheduleController::class)->middleware('doctor');

// Route::view('doctor/schedule/{schedule}', [App\Http\Controllers\PatientMobBookingController::class, 'showMySchedule'])->name('doctor.schedule');
// Route::get('')

