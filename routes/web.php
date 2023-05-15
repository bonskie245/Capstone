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

Route::get('/dashboard/admin', function () {
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
    Route::get('/book/create/doctor/{id}',[App\Http\Controllers\FrontendController::class, 'showDoctor'])->name('booking.showDoctor');
    Route::get('/book/edit/doctor/{id}',[App\Http\Controllers\FrontendController::class, 'showEditDoctor'])->name('booking.showEditDoctor');
    // Route::get('/book/show/edit/doctor/{id}',[App\Http\Controllers\FrontendController::class, 'showDoctor'])->name('booking.showDoctor');
    Route::get('/book/show/Delete/Booking/{id}',[App\Http\Controllers\FrontendController::class, 'showDeleteBooking'])->name('booking.delete');

    Route::Delete('booking/show/Delete/Booking/{id}',[App\Http\Controllers\FrontendController::class, 'deleteBooking'])->name('booking.deleteBooking');
    Route::post('edit/user-profile/change-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-password');
    // Route::get('booking/show/Edit/BookTime/{doctorId}/{id}/{date}',[App\Http\Controllers\FrontendController::class, 'showEditTime'])->name('booking.editTime');
    
    Route::get('booking/show/Edit/BookTime',[App\Http\Controllers\FrontendController::class, 'showEditTime'])->name('booking.editTime');
    Route::put('booking/show/Edit/editTime/{id}',[App\Http\Controllers\FrontendController::class, 'updateTime'])->name('booking.updateTime');
    Route::get('/medicalHistory/Prescription/{id}', [App\Http\Controllers\FrontendController::class, 'showPrescription'])->name('show.prescription');
    // Route::get('users/create/{date}/{id}', [App\Http\Controllers\PatientDashboardController::class, 'getTimeSlot'])->name('booking.timeslot');
    //Patients Dashboad
    Route::get('/booking/calendar',[App\Http\Controllers\UserCalendarController::class, 'index'])->name('calendar.index');
  
});

Route::get('/new-appointment/{doctorID}/{date}', [App\Http\Controllers\FrontendController::class, 'show'])->name('create.appointment');
Route::get('/sales/report',[App\Http\Controllers\PrescriptionController::class, 'chargeReport'])->name('charge.index');

Route::get('medicine/file-import-export', [App\Http\Controllers\medicineController::class, 'fileImportExport'])->name('import.index');
Route::post('file-import', [App\Http\Controllers\medicineController::class, 'fileImport'])->name('file-import');    



/* Admin Route */
Route::group(['middleware'=>['auth','admin']],function(){
    Route::resource('doctor',DoctorController::class);
    Route::resource('department', 'App\Http\Controllers\DepartmentController');
    Route::resource('receptionist', 'App\Http\Controllers\ReceptionistController');
    Route::resource('medicine', 'App\Http\Controllers\medicineController');
    Route::get('/dashboard/admin/aboutUS', [App\Http\Controllers\DashboardController::class, 'aboutUS'])->name('about.index');
    Route::post('/dashboard/admin/aboutUS/store', [App\Http\Controllers\DashboardController::class, 'aboutSubmit'])->name('about.store');
    Route::get('/dashboard/admin/symptoms/create', [App\Http\Controllers\SymptomsController::class, 'create'])->name('symptoms.create');
    Route::post('/dashboard/admin/symptoms/store', [App\Http\Controllers\SymptomsController::class, 'store'])->name('symptoms.store');

});


Route::resource('patient', PatientController::class);
Route::get('/dashboard/admin/patients/prescription/show/{id}/{date}', [App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescription.show');
Route::get('/dashboard/admin/patients/medical/history', [App\Http\Controllers\PrescriptionController::class, 'prescribedPatient'])->name('prescribed.patients');
Route::get('/dashboard/admin/patients/medical/history/{id}',[App\Http\Controllers\PrescriptionController::class, 'showHistory'])->name('medical.show');
Route::get('/dashboard/admin/appointment/charge', [App\Http\Controllers\PatientlistController::class, 'allTimeAppointment'])->name('all.appointments');


Route::resource('walkIn', 'App\Http\Controllers\WalkInPatientController');
Route::get('/walkIn/Appointment/{id}', [App\Http\Controllers\WalkInPatientController::class, 'appointment'])->name('walkIn.appointment');
Route::get('/walkIn/Appointment/{doctorId}/{id}', [App\Http\Controllers\WalkInPatientController::class, 'showTime'])->name('WalkIn.createApp');
    // Route::get('/walkIn/createRecord', [App\Http\Controllers\WalkInPatientController::class, 'createRecord'])->name('walkIn.createRec');
   

// Staff Route

// Route::group(['middleware'=>['auth','receptionist']],function(){
   
// });

/* Doctor Route */
Route::group(['middleware'=>['auth','doctor']],function(){
    Route::resource('appointment',AppointmentController::class);
    Route::get('/dashboard/admin/patients/appointment/showTime/{userID}/{date}',[App\Http\Controllers\AppointmentController::class, 'showTime'])->name('appointment.showTime');
    Route::get('/dashboard/admin/patients/appointment/time/showTime',[App\Http\Controllers\AppointmentController::class, 'showEditTime'])->name('appointment.timeEdit');
    Route::post('/dashboard/admin/patients/prescription/store', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('/dashboard/admin/patientsprescription/create/{id}/{date}/{DocId}',[App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescription.create');
    Route::patch('/dashboard/admin/patientsappointment/edit/editTime/{id}', [App\Http\Controllers\AppointmentController::class, 'updateTime'])->name('appointment.updateTime');
    Route::get('/patients', [App\Http\Controllers\PatientlistController::class, 'index'])->name('patient');
    Route::get('/dashboard/admin/patients/app/today', [App\Http\Controllers\PatientlistController::class, 'patientToday'])->name('patient.today');
    Route::get('/dashboard/admin/patients/status/accept/{id}', [App\Http\Controllers\PatientlistController::class, 'acceptStatus'])->name('accept.status');
    Route::get('/dashboard/admin/patients/status/decline/{id}', [App\Http\Controllers\PatientlistController::class, 'declineStatus'])->name('decline.status');
    Route::get('/dashboard/admin/patients/status/visited/{id}', [App\Http\Controllers\PatientlistController::class, 'visited'])->name('visited.status');
    Route::get('/dashboard/admin/patients/status/visited/not/{id}', [App\Http\Controllers\PatientlistController::class, 'notVisited'])->name('notVisited.status');
    Route::get('/dashboard/admin/patients/patient-today',[App\Http\Controllers\PrescriptionController::class, 'index'])->name('patients.today');
    Route::get('/dashboard/admin/patients/medical/history/show/{id}',[App\Http\Controllers\PatientController::class, 'showHistory'])->name('patient.showHistory');
    Route::get('/dashboard/admin/patientspatients/walk-in/create/{id}',[App\Http\Controllers\WalkInAppController::class, 'create'])->name('walkin.create');
    Route::get('/dashboard/admin/patientspatients/medical/history/prescription/{id}/{date}', [App\Http\Controllers\PatientController::class, 'showPrescription'])->name('patient.prescription');
    Route::get('/dashboard/admin/patientspatients/walk-in/prescription/create/{id}/{date}/{docID}', [App\Http\Controllers\WalkInAppController::class, 'createPrescription'])->name('patient.presCreate');
    Route::get('/dashboard/admin/appointment/all/print/pdf', [App\Http\Controllers\PatientlistController::class, 'generatePDF'])->name('generatePDF');

});