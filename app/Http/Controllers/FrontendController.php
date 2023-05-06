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
use App\Models\PrescriptionMedicines;
use App\Models\About;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class FrontendController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        
        // if(request('app_date')){
        //     $doctors= $this->findDoctorsBasedOnDate(request('app_date'));
        //     $date = request('app_date');
        //     return view('welcome',compact('doctors','date'));
        // }
        // $date = date('Y-m-d');
        //   $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
        //   return view('welcome',compact('doctors','date'));

        return view('welcome');
    }

    public function show($doctorId,$date)
    {
            $appointments = Appointment::where('doctor_id',$doctorId)
                            ->where('app_date',$date)
                            ->where('app_status',0)
                            ->orderBy('time_start')
                            ->get();
           
            $doctor = Doctor::where('id',$doctorId)->first();
            $doctor_id = $doctorId;
            return view('appointment',compact('date','doctor','doctor_id','appointments'));
    }

    


    public function store(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set('Asia/Manila');
        // $request->validate(['time'=>'required']);
        
        $data = $request->all();
        
        $this->validate($request,[
            'time_start'=>'required',
            'book_reason' => 'required'
        ],
        [
            'time_start.required' => 'Appointment Time is required',
            'book_reason.required' => 'Reason is required'
        ]);
        
        $date = $request->app_date;
        $newDate = \Carbon\Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
        $doctorId = $request->doctor_id;

        $countDate = \Carbon\Carbon::parse($newDate)->format('N');
     
        if($countDate == 7)
        {
            return redirect()->back()->with('errmessage','The Clinic is close on Sunday');
        }

        if(in_array("Open wounds", $data['book_reason']))
        {
            $duration = 60 * 60;
        }
        else{
            $count = count(array_filter($data['book_reason'])) * 5;
            $duration = $count * 60;
        }
        
       
        $data['book_reason']= implode(',',array_filter($request->book_reason));

        $starttime = Carbon::parse($request->time_start)->format('H:i');  // hours, minutes, seconds

        $start_time  = strtotime ($starttime);
        $end_time = $start_time + $duration;

        
        if($end_time > strtotime('17:00:00'))
        {
             return redirect()->back()->with('errmessage','The duration of your Appointment exceds 5:00 pm');
        }
        
        // Final Time
        $start = date("H:i", $start_time);      
        $end = date("H:i", $end_time);      
       

        
        $check = Booking::where('app_date', $newDate)
                        ->where('time_start', '<=', $start)
                        ->where('doctor_id', $doctorId)
                        ->where('time_end', '>', $start)
                        ->where('book_status','!=' , '5')
                        ->exists();

        $check2 = Booking::where('app_date', $newDate)
                        ->where('time_start', '<=', $start)
                        ->where('user_id', auth()->user()->id)
                        ->where('time_end', '>', $start)
                        ->where('book_status','!=' , '5')
                        ->exists();
        if($check)
        {
            return redirect()->back()->with('errmessage','You or someone has already booked in this time Frame');
        }
        elseif($check2)
        {
            return redirect()->back()->with('errmessage','You or someone has already booked in this time Frame');
        }
        
        /*Create Booking*/
        $booking = Booking::create([
                'user_id'=>auth()->user()->id,
                'doctor_id' => $doctorId,
                'app_date' => $newDate,
                'book_status'=> 0,
                'book_reason' => $data['book_reason'],
                'time_start' => $start,
                'time_end' =>$end,
        ]);

        return redirect()->route('my.booking')->with('message','Your appointment is Booked Succesfully');

    }

    public function checkBookingTimeInterval($doctorId,$date)
    {
        return Booking::where('user_id',auth()->user()->id)
        ->where('doctor_id',$doctorId)
        ->whereDate('app_date', $date)
        ->where('book_status', '!=', 5)
        ->exists();
    }
    
    public function myBookings()
    {
        $bookingPending = Booking::where('user_id',auth()->user()->id)->where('book_status', '0')
                    ->where('app_date', '>=', Date('Y-m-d'))
                    ->orderBy('created_at','desc')->paginate(10);
        $bookingConfirmed = Booking::where('user_id',auth()->user()->id)->where('book_status', '1')
                    ->where('app_date', '>=', Date('Y-m-d')) 
                    ->orderBy('created_at','desc')->paginate(10);
        $bookingDeclined = Booking::where('user_id',auth()->user()->id)->where('book_status', '4')            
                    ->where('app_date', '>=', Date('Y-m-d'))
                    ->orderBy('created_at','desc')->paginate(10);
        $bookingCancelled = Booking::where('user_id',auth()->user()->id)->where('book_status', '5')
                    ->where('app_date', '>=', Date('Y-m-d'))                
                    ->orderBy('created_at','desc')->paginate(10);
        return view('booking.index',compact('bookingPending','bookingConfirmed','bookingDeclined','bookingCancelled'));
    }
    public function doctorToday(Request $request)
    {
        $doctor = Appointment::with('doctor')
                  ->groupBy('doctor_id')
                  ->whereDate('app_date',date('Y-m-d'))
                  ->get();
                  
        return $doctor;
    }

    public function myPrescription()
    {
        $prescriptions = Prescription::where('user_id',auth()->user()->id)->orderBy('app_date', 'desc')->paginate(5);
        
        return view('my-prescription',compact('prescriptions'));
    }

    public function aboutUs()
    {
        // $doctors  = User::where('role_id','!=',4)
        // ->where('role_id','!=',3)
        // ->where('role_id','!=',1)
        // ->get();
        $about = About::latest('created_at')->first();
        $doctors = Doctor::all();
        return view('about', compact('doctors','about'));
    }

    public function showDoctor($id)
    {
        date_default_timezone_set('Asia/Manila');
        
        
        $doctors = Doctor::find($id);
        // Get The Booking Events array
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
       
        //   $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
        return view('booking.showDoctor',compact('doctors'), ['events' => $events]);
    }
    public function showEditDoctor($id)
    {
        date_default_timezone_set('Asia/Manila');
        
        
        $data = Booking::find($id);

        $doctors = Doctor::find($data->doctor_id);
        // Get The Booking Events array
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
       
        //   $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
        return view('booking.showEditDoctor',compact('doctors','data'), ['events' => $events]);
    }

    // public function showEditTime($doctorId,$id,$date)
    // {
    //        $appointments = Appointment::where('doctor_id',$doctorId)
    //                         ->where('app_date',$date)
    //                         ->where('app_status',0)
    //                         ->orderBy('time_start')
    //                         ->get();

    //        $bookings = Booking::find($id);

    //         $appID = $bookings->app_id;
    //         $doctor = Doctor::where('id',$doctorId)->first();
    //         $doctor_id = $doctorId;
            
    //         return view('booking.showTime',compact('date','doctor','doctor_id','appointments','bookings','appID'));
    // }

    public function showEditTime(Request $request)
    {        
        if($request->date){
            $doctors= $this->findDoctorsBasedOnDate(request('date'),request('doctorId'));
            return response()->json($doctors);          
        }
        if($request->doctorId)
        {
            $doctors = Appointment::where('doctor_id', $request->doctorId)->where('app_date', '>=', date('Y-m-d'))->where('app_status', 0)->get();       
            return response()->json($doctors);
        }    
    }

    public function findDoctorsBasedOnDate($date, $id)
    {
        // $doctors = Appointment::where('app_date', $date)->groupBy('doctor_id')->get();
        $doctors = Appointment::where('app_date', $date)->where('doctor_id', $id)->where('app_status', 0)->get();
        return $doctors;
    }

    public function updateTime(Request $request, $id)
    {
       
        $booking = Booking::find($id);

        $data = $request->all();
        $starttime = Carbon::parse($request->time_start)->format('H:i');  // hours, minutes, seconds

        $start_time  = strtotime ($starttime);
        $end_time = $start_time + $duration;
        $countDate = \Carbon\Carbon::parse($newDate)->format('N');
     
        if($countDate == 7)
        {
            return redirect()->back()->with('errmessage','The Clinic is close on Sunday');
        }
        
        if(in_array("Open wounds", $data['book_reason']))
        {
            $duration = 60 * 60;
        }
        else{
            $count = count(array_filter($data['book_reason'])) * 5;
            $duration = $count * 60;
        }
        
        $data['book_reason']= implode(',',array_filter($request->book_reason));

       
        
            if($end_time > strtotime('17:00:00'))
            {
                return redirect()->back()->with('errmessage','The duration of your Appointment exceds 5:00 pm');
            }
        
        // Final Time
        $start = date("H:i", $start_time);      
        $end = date("H:i", $end_time);      
       

        $this->validate($request,[
            'time_start'=>'required',
            'book_reason' => 'required'
        ],
        [
            'time_start.required' => 'Appointment Time is required',
            'book_reason.required' => 'Reason is required'
        ]);
        
        $date = $request->app_date;
        $newDate = \Carbon\Carbon::createFromFormat('m-d-Y', $date)
        ->format('Y-m-d');
        $doctorId = $request->doctor_id;
        
        $check = Booking::where('app_date', $newDate)
                        ->where('time_start', '<=', $start)
                        ->where('doctor_id', $doctorId)
                        ->where('time_end', '>', $start)
                        ->where('book_status','!=' , '5')
                        ->where('id','!=', $booking->id)
                        ->exists();

        $check2 = Booking::where('app_date', $newDate)
                        ->where('time_start', '<=', $start)
                        ->where('user_id', auth()->user()->id)
                        ->where('time_end', '>', $start)
                        ->where('book_status','!=' , '5')
                        ->where('id','!=', $booking->id)
                        ->exists();
            if($check)
            {
                return redirect()->back()->with('errmessage','This time frame is occupied');
            }
            elseif($check2)
            {
                return redirect()->back()->with('errmessage','This time frame is occupied');
            }
            
        $booking->update([
                'app_date' => $newDate,
                'book_reason' => $data['book_reason'],
                'time_start'=> $start,
                'time_end'=> $end
        ]);
        return redirect()->route('my.booking')->with('message','Reschedule Success');
    }


    public function showDeleteBooking($id)
    {
        $bookings = Booking::find($id);

        return view('booking.delete', compact('bookings'));
    }
    public function deleteBooking($id)
    {
        $bookings = Booking::find($id);
        $appID = $bookings->app_id;

        $bookingsDelete = $bookings->update(['book_status' => '5']);

        if($bookingsDelete){
            Appointment::where('id', $appID)->update(['app_status' => '0']);
        }
        return redirect()->route('my.booking')->with('message','Appointment Cancelled');
    }

    // Show Prescription
    public function showPrescription($id)
    {
        $prescription1 = Prescription::where('id', $id)->first();
        $prescriptions = PrescriptionMedicines::where('prescription_id', $prescription1->id)->get();
       return view('showPrescription',compact('prescriptions','prescription1'));
    }


}

