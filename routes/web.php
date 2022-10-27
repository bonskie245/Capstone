<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\WalkInAppController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\FrontendController;


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

Route::name('auth.resend_confirmation')->get('/register/confirm/resend', 'App\Http\Controllers\Auth\RegisterController@resendConfirmation');
Route::name('auth.confirm')->get('/register/confirm/{confirmation_code}', 'App\Http\Controllers\Auth\RegisterController@confirm');

Route::get('/dashboard/admin', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//FrontEndController 
//*Route::get('/about-us', function () {
//    return view('about');
//});

  Route::get('/about-us', [App\Http\Controllers\FrontendController::class, 'aboutUs'])->name('about');
  Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('welcome');

/* Patient Route */
Route::group(['middleware'=>['auth','patient']],function(){
    Route::get('/dashboard/user', [App\Http\Controllers\PatientDashboardController::class, 'index']);
    Route::resource('users', PatientDashboardController::class);
    Route::post('/book/appointment',[App\Http\Controllers\FrontendController::class, 'store'])->name('booking.appointment');
    Route::get('/my-booking', [App\Http\Controllers\FrontendController::class, 'myBookings'])->name('my.booking');
    Route::get('/dashboard/users', [App\Http\Controllers\PatientDashboardController::class, 'profile']);
    Route::get('/edit/user-profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile-pic', [App\Http\Controllers\ProfileController::class, 'profilePic'])->name('profile.pic');
    Route::get('/medicalHistory', [App\Http\Controllers\FrontendController::class, 'myPrescription'])->name('myPrescription');
    Route::get('/book/show/edit/doctor/{id}',[App\Http\Controllers\FrontendController::class, 'showDoctor'])->name('booking.showDoctor');
    Route::get('/book/show/Delete/Booking/{id}',[App\Http\Controllers\FrontendController::class, 'showDeleteBooking'])->name('booking.delete');

    Route::Delete('booking/show/Delete/Booking/{id}',[App\Http\Controllers\FrontendController::class, 'deleteBooking'])->name('booking.deleteBooking');

    Route::get('booking/show/Edit/BookTime/{doctorId}/{id}/{date}',[App\Http\Controllers\FrontendController::class, 'showEditTime'])->name('booking.editTime');
    Route::put('booking/show/Edit/editTime/{id}',[App\Http\Controllers\FrontendController::class, 'updateTime'])->name('booking.updateTime');
    Route::get('/medicalHistory/Prescription/{id}', [App\Http\Controllers\FrontendController::class, 'showPrescription'])->name('show.prescription');
    
    //Patients Dashboad
  
});

Route::get('/new-appointment/{doctorID}/{date}', [App\Http\Controllers\FrontendController::class, 'show'])->name('create.appointment');

    



/* Admin Route */
Route::group(['middleware'=>['auth','admin']],function(){
    Route::resource('doctor',DoctorController::class);
    Route::get('/patients', [App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');
    Route::get('/patients/all', [App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::get('/status/accept/{id}', [App\Http\Controllers\PatientlistController::class, 'acceptStatus'])->name('accept.status');
    Route::get('/status/decline/{id}', [App\Http\Controllers\PatientlistController::class, 'declineStatus'])->name('decline.status');
    Route::resource('department', 'App\Http\Controllers\DepartmentController');
    Route::resource('patient', 'App\Http\Controllers\PatientController');
    Route::resource('receptionist', 'App\Http\Controllers\ReceptionistController');
    Route::resource('medicine', 'App\Http\Controllers\medicineController');
});


Route::resource('walkIn', 'App\Http\Controllers\WalkInPatientController');
Route::get('/walkIn/Appointment/{id}', [App\Http\Controllers\WalkInPatientController::class, 'appointment'])->name('walkIn.appointment');
Route::get('/walkIn/Appointment/{doctorId}/{date}/{id}', [App\Http\Controllers\WalkInPatientController::class, 'showTime'])->name('WalkIn.createApp');
    // Route::get('/walkIn/createRecord', [App\Http\Controllers\WalkInPatientController::class, 'createRecord'])->name('walkIn.createRec');
   

// Staff Route

// Route::group(['middleware'=>['auth','receptionist']],function(){
   
// });

/* Doctor Route */
Route::group(['middleware'=>['auth','doctor']],function(){
    Route::resource('appointment',AppointmentController::class);
    Route::get('/appointment/showTime/{userID}/{date}',[App\Http\Controllers\AppointmentController::class, 'showTime'])->name('appointment.showTime');
    Route::get('/appointment/time/showTime',[App\Http\Controllers\AppointmentController::class, 'showEditTime'])->name('appointment.timeEdit');
    Route::post('/prescription/store', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('prescription/create/{id}/{date}/{DocId}',[App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescription.create');
    Route::get('/prescription/show/{id}/{date}', [App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescription.show');
    Route::get('/patients/medical/history', [App\Http\Controllers\PrescriptionController::class, 'prescribedPatient'])->name('prescribed.patients');
    Route::patch('appointment/edit/editTime/{id}', [App\Http\Controllers\AppointmentController::class, 'updateTime'])->name('appointment.updateTime');
    Route::get('/patients', [App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');
    Route::get('/patients/app/today', [App\Http\Controllers\PatientlistController::class, 'patientToday'])->name('patient.today');
    Route::get('/patients/all', [App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::get('/status/accept/{id}', [App\Http\Controllers\PatientlistController::class, 'acceptStatus'])->name('accept.status');
    Route::get('/status/decline/{id}', [App\Http\Controllers\PatientlistController::class, 'declineStatus'])->name('decline.status');
    Route::get('/status/visited/{id}', [App\Http\Controllers\PatientlistController::class, 'visited'])->name('visited.status');
    Route::get('/status/visited/not/{id}', [App\Http\Controllers\PatientlistController::class, 'notVisited'])->name('notVisited.status');
    Route::get('patient-today',[App\Http\Controllers\PrescriptionController::class, 'index'])->name('patients.today');
    Route::resource('patient', PatientController::class);
    Route::get('/patient/medical/{id}',[App\Http\Controllers\PrescriptionController::class, 'showHistory'])->name('medical.show');
    Route::get('/patient/medical-history/{id}',[App\Http\Controllers\PatientController::class, 'showHistory'])->name('patient.showHistory');
    Route::resource('walkin', WalkInAppController::class);
    Route::get('patient/walk-in/create/{id}',[App\Http\Controllers\WalkInAppController::class, 'create'])->name('walkin.create');
    Route::get('patient/medical-history/prescription/{id}/{date}', [App\Http\Controllers\PatientController::class, 'showPrescription'])->name('patient.prescription');
    Route::get('patient/walk-in/prescription/create/{id}/{date}/{docID}', [App\Http\Controllers\WalkInAppController::class, 'createPrescription'])->name('patient.presCreate');
});