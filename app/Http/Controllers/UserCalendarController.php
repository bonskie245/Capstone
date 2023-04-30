<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Prescription;
use App\Mail\AppointmentMail;
use Carbon\Carbon;
use PDF;
class UserCalendarController extends Controller
{
    public function index()
    {
          // Booking status 0 - pending
        // Booking status 1 - Accepted
        // Booking status 2 - Visited
        // Booking status 3 - Not visited
        // Booking status 4 - Declined
        // Booking status 5 - Cancelled
        // Booking status 6 - Finished

        $events = array();
        $bookings = Booking::get();
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
                    elseif($booking->book_status == 4){
                        $eventColor =  '#b51307';
                    }
                    elseif($booking->book_status == 5){
                        $eventColor =  '#DD3E3E';
                    }
                    else{
                        $eventColor = '#0000FF';
                    }

                    foreach($booking->user as $user)
                    {
                        $name = $user->user_fName. ' '. $user->user_lName;  
                    }
                    
                    
                    $doctorname = $booking->doctor->user->user_fName. ' '. $booking->doctor->user->user_lName;
                    
                        $start = $booking->app_date. ' '. $booking->time_start;
                        $end = $booking->app_date. ' '. $booking->time_end;

                    $events[] = [
                        'title' => $name . ' Booking' . ' with Dr. '. $doctorname ,
                        'start' => Carbon::parse($start)->toDateTimeString(),
                        'end' => Carbon::parse($end)->toDateTimeString(),
                        'color' => $eventColor
                     ];       
            }
           
        return view('userCalendar', ['events' => $events]);
    }
}
