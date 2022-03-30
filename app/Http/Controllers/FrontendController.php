<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Booking;
use App\Mail\AppointmentMail;
use App\Models\Prescription;

class FrontendController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        
        if(request('app_date')){
            $doctors= $this->findDoctorsBasedOnDate(request('app_date'));
            return view('welcome',compact('doctors'));
        }
        
          $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('user_id')->get();
          return view('welcome',compact('doctors'));

    }
    public function show($doctorId,$date)
    {
            $appointments = Appointment::where('user_id',$doctorId)->where('app_date',$date)->where('app_status',0)->get();
            //$times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
            $user = User::where('id',$doctorId)->first();
            $doctor_id = $doctorId;
            return view('appointment',compact('date','user','doctor_id','appointments'));
    }

    public function findDoctorsBasedOnDate($date)
    {
        $doctors = Appointment::where('app_date', $date)->groupBy('user_id')->get();
        return $doctors;
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
       // $request->validate(['time'=>'required']);
        
        $check = $this->checkBookingTimeInterval();
        
        if($check){
            return redirect()->back()->with('errmessage','You already made an Appointment. Please wait to make next appointment');
        }
        /*Create Booking*/
        Booking::create([
                'user_id'=>auth()->user()->id,
                'doctor_id' => $request->doctorId,
                'time_start' => $request->time_start, 
                'time_end' => $request->time_end,
                'app_date'=> $request->app_date,
                'app_status'=> 0
        ]);

        //Time::where('appointment_id',$request->appointmentId)
         //   ->where('time', $request->time)
        //    ->update(['status'=> 1]);
        

        //send email notification
            $doctorName = User::where('id',$request->doctorId)->first();
            
              $mailData = [
               'name'=>auth()->user()->user_fName,
               'time'=>$request->time,
               'date'=>$request->date,
               'doctorName' =>$doctorName->user_lName, 
           ];
            
           try{
                \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));

           }catch(\Exception $e){

            }


        return redirect()->back()->with('message','Your appointment is Booked Succesfully');
    }

    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id','desc')
        ->where('user_id',auth()->user()->id)
        ->whereDate('created_at',date('Y-m-d'))
        ->exists();
    }
    public function myBookings()
    {
        $appointments = Booking::where('user_id',auth()->user()->id)->get();
        return view('booking.index',compact('appointments'));
    }

    public function doctorToday(Request $request)
    {
        $doctor = Appointment::with('doctor')->groupBy('user_id')->whereDate('app_date',date('Y-m-d'))->get();
        return $doctor;
    }

    public function myPrescription()
    {
        $prescriptions = Prescription::where('user_id',auth()->user()->id)->get();
        return view('my-prescription',compact('prescriptions'));
    }
}

