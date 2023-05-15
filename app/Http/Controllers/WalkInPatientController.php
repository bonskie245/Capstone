<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\WalkIn_Patient;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WalkInPatientController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  = User::where('role_id','!=',2)
        ->where('role_id','!=',3)
        ->where('role_id','!=',1)
        ->paginate(10);
        return view('admin.walkInAppointment.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.walkInAppointment.create');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->all();
       date_default_timezone_set('Asia/Manila');
       // $request->validate(['time'=>'required']);
       
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
                       ->exists();
       if($check)
       {
           return redirect()->back()->with('errmessage','You or someone has already booked in this time Frame');
       }
       
        /*Create Booking*/
        $booking = Booking::create([
                'user_id'=>$request->user_id,
                'doctor_id' => $doctorId,
                'app_date' => $newDate,
                'book_status'=> 0,
                'book_reason' => $data['book_reason'],
                'time_start' => $start,
                'time_end' =>$end,
        ]);


        return redirect()->route('patient.index')->with('message','Your appointment is Booked Succesfully');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = WalkIn_Patient::find($id);

        return view('admin.walkInAppointment.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData =  $request->validate([
            'patient_fName' => 'required',
            'patient_lName' => 'required',
            'patient_gender' => 'required',
            'patient_address' => 'required',
            'patient_phoneNum' => 'required',
        ]);

       WalkIn_Patient::whereId($id)->update($validateData);

        return redirect()->route('walkIn.index')->with('message','Patient Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = WalkIn_Patient::find($id);
        $patient->delete();

        return redirect()->route('walkIn.index')->with('message','Patient Deleted');
    }

    public function appointment($id, Request $request)
    {
         date_default_timezone_set('Asia/Manila');
        
         $users = User::find($id);

         if($request->date){
            $doctors= $this->findDoctorsBasedOnDate(request('date'),request('doctorId'));
            return response()->json($doctors);
            // return view('bookapp',compact('doctors','date'));
        }

        if($request->doctorId)
        {
            // $doctors = Appointment::where('doctor_id', $request->doctorId)->where('app_date', '>=', date('Y-m-d'))->groupBy('app_date')->distinct()->get();
            $doctors = Appointment::where('doctor_id', $request->doctorId)->where('app_date', '>=', date('Y-m-d'))->where('app_status', 0)->get();
              
            return response()->json($doctors);
        }
        
        $date = date('Y-m-d');
        // $doctors = Appointment::select('*')->where('app_date',date('Y-m-d'))->groupBy('doctor_id')->orderBy('time_start')->get();
        
        $doctors = Doctor::all();
        $dates = array();
        
        $availableDate = Appointment::groupBy('app_date')->distinct()->get();
        
        foreach($availableDate as $date){
            
            $dates [] = [
                'app_date' =>  $date->app_date,
                'doctor_id' => $date->doctor_id
            ];
        }

          return view('admin.walkInAppointment.appointment',compact('doctors','date','dates','users'));
    }
    
    public function findDoctorsBasedOnDate($date, $id)
    {
        // $doctors = Appointment::where('app_date', $date)->groupBy('doctor_id')->get();
        $doctors = Appointment::where('app_date', $date)->where('doctor_id', $id)->where('app_status', 0)->get();
        return $doctors;
    }

    public function showTime($doctorId,$id)
    {
        $users = User::find($id);
        $doctor = Doctor::where('id',$doctorId)->first();
        $doctor_id = $doctorId;
        
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

        return view('admin.walkInAppointment.showTime',compact('doctor','doctor_id','users'),['events' => $events]);
    }

    public function checkBookingTimeInterval($doctorId,$userid,$date)
    {
        return Booking::orderby('id','desc')
        ->where('user_id',$userid)
        ->where('doctor_id',$doctorId)
        ->whereDate('app_date', $date)
        ->where('book_status', '!=', 5)
        ->exists();
    }
   



}
