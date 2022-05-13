<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Booking;
use App\Mail\AppointmentMail;
use App\Models\Prescription;
use App\Models\Doctor;

class FrontendController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        
        if(request('app_date')){
            $doctors= $this->findDoctorsBasedOnDate(request('app_date'));
            $date = request('app_date');
            return view('welcome',compact('doctors','date'));
        }
        $date = date('Y-m-d');
          $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
          return view('welcome',compact('doctors','date'));

    }

    public function show($doctorId,$date)
    {
            $appointments = Appointment::where('doctor_id',$doctorId)->where('app_date',$date)->where('app_status',0)->orderBy('time_start')->get();
            //$times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
            $doctor = Doctor::where('id',$doctorId)->first();
            $doctor_id = $doctorId;
            return view('appointment',compact('date','doctor','doctor_id','appointments'));
    }

    public function findDoctorsBasedOnDate($date)
    {
        $doctors = Appointment::where('app_date', $date)->groupBy('doctor_id')->get();
        return $doctors;
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
       // $request->validate(['time'=>'required']);
        
        $check = $this->checkBookingTimeInterval($request->doctorId);
        
        if($check){
            return redirect()->back()->with('errmessage','You already made an Appointment for today. Please wait tomorrow to make next appointment');
        }

        /*Create Booking*/
        $booking = Booking::create([
                'app_id'=> $request->app_id,
                'user_id'=>auth()->user()->id,
                'doctor_id' => $request->doctorId,
                'app_date' => $request->app_date,
                'book_status'=> 0
        ]);

        if($booking){
            Appointment::where('id',$request->app_id)
                        ->update(['app_status' => 1]);
        }

        //Time::where('appointment_id',$request->appointmentId)
         //   ->where('time', $request->time)
        //    ->update(['status'=> 1]);
        

        //send email notification
            $doctorName = Doctor::where('id',$request->doctorId)->first();
            
            $mailData = [
                'fName'=> $userID->user_fName, 
                'lName'=> $userID->user_lName,
                'time_start'=>$appointment->time_start,
                'time_end'=>$appointment->time_end,
                'app_date'=>$booking->app_date,
                'doctor_fName' =>$doctorID->user->user_fName, 
                'doctor_LName' =>$doctorID->user->user_lName, 
                    ];
            
           try{
                \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));

           }catch(\Exception $e){

            } 
        return redirect()->back()->with('message','Your appointment is Booked Succesfully');
    }

    public function checkBookingTimeInterval($doctorId)
    {
        return Booking::orderby('id','desc')
        ->where('user_id',auth()->user()->id)
        ->where('doctor_id',$doctorId)
        ->whereDate('app_date',date('Y-m-d'))
        ->exists();
    }
    
    public function myBookings()
    {
        $bookings = Booking::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return view('booking.index',compact('bookings'));
    }

    public function doctorToday(Request $request)
    {
        $doctor = Appointment::with('doctor')->groupBy('doctor_id')->whereDate('app_date',date('Y-m-d'))->get();
        return $doctor;
    }

    public function myPrescription()
    {
        $prescriptions = Prescription::where('user_id',auth()->user()->id)->get();
        return view('my-prescription',compact('prescriptions'));
    }

    public function aboutUs()
    {
        $doctors  = User::where('role_id','!=',4)
        ->where('role_id','!=',3)
        ->where('role_id','!=',1)
        ->get();
        return view('about', compact('doctors'));
    }
}

