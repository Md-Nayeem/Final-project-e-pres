<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminUsersController;

//testing notification
use App\Models\User;
use App\Notifications\InvoicePaid;
use App\Models\Doctor;
use App\Models\Appointment;

use App\Notifications\PaymentDone;


use Illuminate\Foundation\Auth\EmailVerificationRequest;



// use PDF;  //testing

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


//email varification 


    //to display a notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');


    //handle requests generated when the user clicks the email verification link in the email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/patient'); //edit herer.
    })->middleware(['auth', 'signed'])->name('verification.verify');

    //verification email be resent
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Email end

Route::get('/', function () {
    // return view('welcome');
    return view('guest.index');
});

Route::get('/text',function(){
    return view('text');
});

Route::get('/guest',function(){
    return view('guest.index');
});

Route::get('/guest/reg',function(){
    return view('guest.create');
})->name('gst.create');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::resource('admin-dc', AdminUsersController::class);

// Route::resource('admin-dc-dpt', App\Http\Controllers\Departmentcontroller::class);

// Route::resource('admin-dc-dist', App\Http\Controllers\DistrictController::class);


// Admin -> Doctor
Route::middleware(['auth','admin'])->prefix('admin-dc')->name('admin-dc.')->group(function(){
    // Route::resource('/', AdminUsersController::class);
    Route::resource('/', App\Http\Controllers\AdminDoctorController::class);
    Route::get('assignedList',[App\Http\Controllers\AdminDoctorController::class, 'assignedStaffToDoctorList'])->name('assigntolist');
    Route::post('assign', [App\Http\Controllers\AdminDoctorController::class, 'assignStaffToDoctor'])->name('assign');
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
    Route::post('all',[App\Http\Controllers\DoctorPrescriptionController::class,'showAllPrecribedPrescriptions'])->name('all');
    // Route::post('mypatientlist', [App\Http\Controllers\DoctorPrescriptionController::class, 'patientlist'])->name('patientlist');
});


// Only Patient
Route::resource('pt', App\Http\Controllers\PatientController::class)->middleware('auth');
// get the medical of a patient
Route::get('pt/mtl/{mtl}', [App\Http\Controllers\PatientController::class, 'medicalTimeLine'])->middleware('auth')->name('pt.mtl');

// Index shows the doctor search 
Route::resource('patient', App\Http\Controllers\PatientMobBookingController::class)->middleware('auth');

Route::post('patient/makeAppointment', [App\Http\Controllers\PatientMobBookingController::class, 'makeAppointment'])->name('patient.makeAppointment');

Route::get('patient/appointments/{appointments}', [App\Http\Controllers\PatientMobBookingController::class, 'viewMyAppointments'])->name('patient.appointments');
// Route::get('doctor/')


// Patient appointments + Prescription 
Route::resource('patient-pres', App\Http\Controllers\PatientAppointmentPrescriptionController::class)->middleware('auth');

// Pres PDF 
Route::get('patient-pres/createPDF/{createPDF}',[App\Http\Controllers\PatientAppointmentPrescriptionController::class,'CreatePDF'])->name('patient-pres.createPDF')->middleware('auth');

// Route::patch('patient-pres/updatePrivacy/{updatePrivacy}',[App\Http\Controllers\PatientAppointmentPrescriptionController::class,'updatePrivacy'])->name('patient.updatePrivacy')->middleware('auth');

Route::get('patient/prescriptionsList/{prescriptionsList}',[App\Http\Controllers\PatientAppointmentPrescriptionController::class,'prescriptionsList'])->name('patient.prescriptionsList')->middleware('auth');




// confusion here!!!
Route::post('doctor/search', [App\Http\Controllers\PatientMobBookingController::class, 'search'])->name('doctor.search');




Route::resource('dc-schedule', App\Http\Controllers\DoctorScheduleController::class)->middleware('doctor');

// Route::view('doctor/schedule/{schedule}', [App\Http\Controllers\PatientMobBookingController::class, 'showMySchedule'])->name('doctor.schedule');
// Route::get('')


Route::resource('st-ap', App\Http\Controllers\StaffAppointmentPaymentController::class)->middleware('staff');
Route::get('st-ap/visitedStatus/{visitedStatus}', [App\Http\Controllers\StaffAppointmentPaymentController::class,'changeVisitedStatus'])->middleware('staff')->name('st-ap.visitedStatus');


// SSLCOMMERZ Start
Route::get('payment/{payment}', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('payment');
Route::get('/example2', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [App\Http\Controllers\SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [App\Http\Controllers\SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [App\Http\Controllers\SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [App\Http\Controllers\SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [App\Http\Controllers\SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [App\Http\Controllers\SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END




route::get('msg',function(){
    
    //Notify the Patient 
    if($user = Auth::user()){
        $user->notify(new PaymentDone);
    }

    return view('payment.message');
})->name('msg');



// Notification 

Route::get('/notification',function(){
    // $ap = Appointment::findOrFail(1);
    // return (new InvoicePaid($ap))
    //     ->toDatabase($ap->doctor->user);



    User::findOrFail(1)->notify(new InvoicePaid);


});
Route::get('/getnotifi',function(){
    // $ap = Appointment::findOrFail(1);
    // return (new InvoicePaid($ap))
    //     ->toDatabase($ap->doctor->user);


    $user = User::findOrFail(1);
    // $user = App\Models\User::find(1);

    foreach ($user->notifications as $notification) {
        echo $notification->data['message'];
    }


});

