<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);



//FrontEndController 
  Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('welcome');


/* Patient Route */
Route::group(['middleware'=>['auth','patient']],function(){
    Route::post('/book/appointment',[App\Http\Controllers\FrontendController::class, 'store'])->name('booking.appointment');
    Route::get('/my-booking', [App\Http\Controllers\FrontendController::class, 'myBookings'])->name('my.booking');
  
    Route::get('/new-appointment/{doctorID}/{date}', [App\Http\Controllers\FrontendController::class, 'show'])->name('create.appointment');


    Route::get('/user-profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile-pic', [App\Http\Controllers\ProfileController::class, 'profilePic'])->name('profile.pic');
    Route::get('/my-prescription', [App\Http\Controllers\FrontendController::class, 'myPrescription'])->name('myPrescription');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* Admin Route */
Route::group(['middleware'=>['auth','admin']],function(){
    Route::resource('doctor',DoctorController::class);
    Route::get('/patients', [App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');
    Route::get('/patients/all', [App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::get('/status/accept/{id}', [App\Http\Controllers\PatientlistController::class, 'acceptStatus'])->name('accept.status');
    Route::get('/status/decline/{id}', [App\Http\Controllers\PatientlistController::class, 'declineStatus'])->name('decline.status');


});

/* Doctor Route */
Route::group(['middleware'=>['auth','doctor']],function(){
    Route::resource('appointment',AppointmentController::class);
    Route::post('/appointment/check',[App\Http\Controllers\AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update',[App\Http\Controllers\AppointmentController::class, 'updateTime'])->name('update');
    Route::get('/patients', [App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');
    Route::get('/patients/all', [App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::get('/status/accept/{id}', [App\Http\Controllers\PatientlistController::class, 'acceptStatus'])->name('accept.status');
    Route::get('/status/decline/{id}', [App\Http\Controllers\PatientlistController::class, 'declineStatus'])->name('decline.status');
    Route::get('patient-today',[App\Http\Controllers\PrescriptionController::class, 'index'])->name('patients.today');
    Route::post('/prescription', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('/prescription/{userID}/{date}', [App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescription.show');
    Route::get('/prescribed-patients', [App\Http\Controllers\PrescriptionController::class, 'prescribedPatient'])->name('prescribed.patients');
});