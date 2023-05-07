<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Label84\HoursHelper\Facades\HoursHelper;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //need to change
    public function index()
    {
        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        // $doctor = Doctor::get();
        $doctors= array();
        
        // foreach($doctor as $doc){
        //  $doctors = $doc->user->user_fName . ' ' . $doc->user->user_lName;
        // }
        $doctors = $doctor->user->user_fName . ' ' . $doctor->user->user_lName. 'Appointment';
        // $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();

        $myappointment = Appointment::select('app_date')->where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();
        $appointment = array();
        $color = null;
        $myappointments = Appointment::where('doctor_id', $doctor->id)->get();
        // $myappointments = Appointment::get();

        foreach($myappointments as $myappointment)
        {
            $start =  $myappointment->app_date . ' ' . $myappointment->time_start;
            $end = $myappointment->app_date . ' ' . $myappointment->time_end;
            
            if($myappointment->app_status == 0){
                $color =  '#47ceff';
            }
            else{
                $color =  '#b51307';
            }
            $appointment [] =[
                'id' => $myappointment->id,
                'title' => 'Dr.'. $myappointment->doctor->user->user_fName. ' ' .  $myappointment->doctor->user->user_lName . ' Appointment',
                'start' =>  Carbon::parse($start)->toDateTimeString(),
                'end' =>  Carbon::parse($end)->toDateTimeString(),
                'color' => $color,
            ];
        }
        
        return view('admin.appointment.index', compact('appointment', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){
        // Using Times helper

        // Check if time start is greater than time end

        dd($request->all());
            // Get date Ranges
            $startDate = Carbon::createFromFormat('Y-m-d', $request->app_date)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('Y-m-d', $request->app_date2)->format('Y-m-d');

            $daterange = CarbonPeriod::create($startDate, $endDate);
      
        
      
    foreach ($daterange as $date) 
    {  
        
    }
        return redirect()->route('appointment.create')->with('message', 'Has been added');
    
    }   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('admin.appointment.delete',compact('appointment'));
    }

  
    /**U
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointments = Appointment::where('id',$id)->get();
        //$times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
        return view('admin.appointment.edit',compact('appointments'));
    }

  

    //need to change
    public function showTime($id, $date)
    {

        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        $appointments = Appointment::where('doctor_id',$doctor->id)->where('app_date', $date)->orderBy('time_start')->get();
        //$times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
        return view('admin.appointment.showTime',compact('appointments'));
    }

    public function timeEdit()
    {
        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();

        return view('admin.appointment.editTime',compact('myappointment'));
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
        $appointment = Appointment::find($id);
        $data = $request->all();

        $time_start = Carbon::parse($request->time_start)->toTimeString();
        $time_end = Carbon::parse($request->time_end)->toTimeString();
        
        // if(! $appointment){
        //     return response()->json([
        //         'error' =>'Unable to locate ID'
        //     ], 404);
        // }

        $appointment->update([
            'time_start' => $time_start,
            'time_end' => $time_end,
        ]);
        
        // return response()->json($appointment);
        return redirect()->route('appointment.index')->with('message','Appointment Edited Successfuly');
    }

    public function updateTime(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        // $data [] = ['app_date' => $request->app_date,
        //             'time_start' => $request->time_start,
        //             'time_end' => $request->time_end,
        //             'doctor_id' => $request->doctorId];

        $checkAppointment = Appointment::where('doctor_id', $request->doctorId)
                                        ->where('app_date', $request->app_date)
                                        ->where('time_start', '<=' ,$request->time_start)
                                        ->where('time_end', '>',  $request->time_start)
                                        ->exists();

        // First If
        if(! $appointment)
        {
            return response()->json([
                'error' =>'Unable to locate ID'
            ], 404);
        }
        else
        {
                // Second If

                if($checkAppointment)
                {
                    return response()->json([
                        'error' => true,
                        'message' =>  'The appointment already exist',
                    ], 404);
                }
                else
                {
                    if($request->app_date < date('Y-m-d')){
                        return response()->json([
                            'error' =>true,
                            'message' => 'The date you have chosen is a past date',
                        ], 404);
                    }
                    if($appointment->app_status == 1){
                        return response()->json([
                            'error' =>true,
                            'message' => 'This appointment is already occupied',
                        ], 404);
                    }
                    $appointment->update([
                        'app_date' => $request->app_date,
                        'time_start' => $request->time_start,
                        'time_end' => $request->time_end
                    ]);
                    // return response()->json($request->time_start);
                        return response()->json("$appointment");
                    // return redirect()->route('appointment.index')->with('message','Appointment Edited Successfuly');    
                }
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return $id;
        // return redirect()->route('appointment.index')->with('errmessage','Appointment Deleted Successfuly');
    }

    public function showEditTime()
    {
        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        // $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();
        $myappointment = Appointment::select('*')->where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();

        return view('admin.appointment.editTime',compact('myappointment'));
    }

}
