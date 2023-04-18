<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Mail\AppointmentMail;
use Carbon\Carbon;

class PatientlistController extends Controller
{
    
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        if($request->app_date){
             $bookings =Booking::latest()->where('app_date',$request->app_date)->get();
            return view('patientlist.index',compact('bookings'));
        }          
           
            // Get The Booking Events array
            $events = array();
            $bookings = Booking::with("appointment")->get();
            
 
            $eventColor = null; 

            foreach($bookings as $booking)
            {
                    if($booking->book_status == 0){
                        $eventColor =  '#727573';
                    }
                    elseif($booking->book_status == 1){
                        $eventColor =  '#12f50a';
                    }
                    elseif($booking->book_status == 2){
                        $eventColor =  '#47ceff';
                    }
                    elseif($booking->book_status == 3){
                        $eventColor =  '#eb095c';
                    }
                    else{
                        $eventColor =  '#b51307';
                    }

                    foreach($booking->user as $user)
                    {
                        $name = $user->user_fName. ' '. $user->user_lName;  
                    }
                    foreach($booking->appointment as $appointment)
                    {
                        $start = $appointment->app_date. ' '. $appointment->time_start;
                        $end = $appointment->app_date. ' '. $appointment->time_end;
                    }
                   
                   
                    $events[] = [
                        'title' => $name . ' Booking' ,
                        'start' => Carbon::parse($start)->toDateTimeString(),
                        'end' => Carbon::parse($end)->toDateTimeString(),
                        'color' => $eventColor
                     ];       
            }
           

            return view('patientlist.index', ['events' => $events]);
        }

    public function acceptStatus($id)
    {
        
         // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        $booking = Booking::find($id);
        // $booking->book_status = 1;
            $booking->update([
                'book_status' => 1,
            ]);
        // $bookings = $booking->();   

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
            'doctor_lName' =>$doctorID->user->user_lName, 
            ];
         
            $email = $userID->email;
            
        
            // Mail::to("$userID->email")->send(new AppointmentMail($mailData));

            // return "email sent";
             return redirect()->route('patient')->with('message','Appointment Accepted');
       
    }

   public function declineStatus($id)
    {
           // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        $booking = Booking::find($id);

        $appID = $booking->app_id;
        
        $appointment = Appointment::where('id', $appID)->update(['app_status' => '0']);

        $booking->book_status = 4;
        $booking->save();   
        return redirect()->back()->with('errmessage','Appointment Declined');
    }

    public function visited($id)
    {
         // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        $booking = Booking::find($id);


        $booking->book_status = 2;
        $booking->save();   
        return redirect()->back()->with('message','Patient Has arrived at the Appointment');
    }

    public function notVisited($id)
    {
          // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        $booking = Booking::find($id);


        $booking->book_status = 3;
        $booking->save();   
        return redirect()->back()->with('errmessage','Patient did not arrive at the Appointment');
    }
    
    public function allTimeAppointment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        if($request->date_from){
            $from = $request->date_from;
            $to = $request->date_to;

            $bookings =Booking::where('book_status', '6')->whereBetween('app_date',[$from,$to])>latest()->paginate(10);
           return view('patientlist.allpatient',compact('bookings'));
       }          

        $bookings =Booking::where('book_status', '6')->latest()->paginate(10);
            return view('patientlist.allpatient',compact('bookings'));

    }
    public function patientToday(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
            if($request->app_date){
                $bookings =Booking::latest()->where('app_date',$request->app_date)->get();
            return view('patientlist.patientToday',compact('bookings'));
        }          
            // $appointments = Appointment::where('app_date',date('Y-m-d'))->where('app_status','1')->get();
            // foreach($appointments as $appointment){
            //     dd($bookings = Booking::where('app_id',$appointment->id)->get());
            // }
            $bookingPending =Booking::where('app_date', '>=', date('Y-m-d'))
            ->where('book_status', '0')
            ->paginate(5);
            $bookingConfirmed =Booking::where('app_date', '>=',date('Y-m-d'))
            ->whereBetween('book_status', [1,3])->paginate(5);
            $bookingDeclined =Booking::where('app_date', '>=', date('Y-m-d'))
            ->where('book_status', '4')
            ->paginate(5);
            $bookingCancelled =Booking::where('app_date', '>=', date('Y-m-d'))
            ->where('book_status', '5')->paginate(5);
            // $bookingPending =Booking::where('app_date', date('Y-m-d'))->where('book_status', '0')->paginate(5);
                
             return view('patientlist.patientToday',compact('bookingPending','bookingConfirmed','bookingDeclined','bookingCancelled'));
    }
}
