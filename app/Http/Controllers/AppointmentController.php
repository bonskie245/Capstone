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
        $doctors= array();
        $doctors = $doctor->user->user_fName . ' ' . $doctor->user->user_lName;
        
        // $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();
        $appointment = array();
        $color = null;
        $myappointments = Appointment::where('doctor_id', $doctor->id)->get();

        foreach($myappointments as $myappointment){
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
                'title' => 'Dr.'. $myappointment->doctor->user->user_fName. ' ' .  $myappointment->doctor->user->user_lName ,
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
    //need to change
    public function store(Request $request)
    {
        $this->validate($request,[
            'app_date'=>'required',
            'time_start'=>'required',
            'time_end'=>'required|after:time_start' 
        ]);
        $time_start = Carbon::parse($request->time_start)->toTimeString();
        $time_end = Carbon::parse($request->time_end)->toTimeString();

        $doctor = Doctor::where('user_id',auth()->user()->id)->first();

        $checkAppointment = Appointment::where('doctor_id', $doctor->id)
                                        ->where('app_date', $request->app_date)
                                        ->where('time_start', '<=' ,$time_start)
                                        ->where('time_end', '>',  $time_start)
                                        ->exists();

    
        if($checkAppointment){
            // return response()->json([
            //     'errors' =>'Appointment Date/Time exist or overlaps'
            // ], 404);
            return redirect()->route('appointment.index')->with('errmessage','Appointment Date & time exist or overlaps');
        }

        $appointment = Appointment::create([
            'doctor_id'=> $doctor->id,
            'app_date'=> $request->app_date,
            'time_start' => $time_start,
            'time_end' => $time_end,
        ]);

        // return response()->json($appointment);
        return redirect()->back()->with('message','Appointment Created for '. $request->app_date);
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

  
    /**
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
        $data = $request->all();

        
        if(! $appointment){
            return response()->json([
                'error' =>'Unable to locate ID'
            ], 404);
        }

        $appointment->update($data);
        
        return response()->json($appointment);
        return redirect()->route('appointment.index')->with('message','Appointment Edited Successfuly');
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
        return redirect()->route('appointment.index')->with('errmessage','Appointment Deleted Successfuly');
    }

    public function showEditTime()
    {
        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();

        return view('admin.appointment.editTime',compact('myappointment'));
    }

}
