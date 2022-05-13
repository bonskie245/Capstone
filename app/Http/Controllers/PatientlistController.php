<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Mail\AppointmentMail;

class PatientlistController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if($request->app_date){
             $bookings =Booking::latest()->where('app_date',$request->app_date)->get();
            return view('patientlist.index',compact('bookings'));
        }          
           /* $appointments = Appointment::where('app_date',date('Y-m-d'))->where('app_status','1')->get();
            foreach($appointments as $appointment){
                dd($bookings = Booking::where('app_id',$appointment->id)->get());
            }*/
            $bookings =Booking::latest()->where('app_date',date('Y-m-d'))->get();
            return view('patientlist.index',compact('bookings'));

    }

    public function acceptStatus($id)
    {
        $booking = Booking::find($id);
        $booking->book_status = 1;
        $booking->save();   
       
       
                $doctorID = Doctor::where('id', $booking->doctor_id)->first();
                $userID = User::where('id', $booking->user_id)->first();
                $appointment = Appointment::where('id', $booking->app_id)->first();
       
              $mailData = [
            'fName'=> $userID->user_fName, 
            'lName'=> $userID->user_lName,
            'time_start'=>$appointment->time_start,
            'time_end'=>$appointment->time_end,
            'app_date'=>$booking->app_date,
            'doctor_fName' =>$doctorID->user->user_fName, 
            'doctor_LName' =>$doctorID->user->user_lName, 
                ];
         
            if($booking->save()){
        try{
            \Mail::to($userID->email)->send(new AppointmentMail($mailData));
            
          }catch(\Exception $e){

            } 
        }
         
        return redirect()->back()->with('message','Appointment Accepted');
       
    }

   public function declineStatus($id)
    {
        $booking = Booking::find($id);

        $appID = $booking->app_id;
        
        $appointment = Appointment::where('id', $appID)->update(['app_status' => '0']);

        $booking->book_status = 2;
        $booking->save();   
        return redirect()->back()->with('errmessage','Appointment Declined');
    }

    public function allTimeAppointment(Request $request)
    {
        if($request->app_date){
            $bookings =Booking::latest()->where('app_date',$request->app_date)->get();
           return view('patientlist.index',compact('bookings'));
       }          
        $bookings =Booking::latest()->paginate(20);
            return view('patientlist.allpatient',compact('bookings'));

    }
}
