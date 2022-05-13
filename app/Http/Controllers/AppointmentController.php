<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;

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
        $myappointment = Appointment::where('doctor_id', $doctor->id)->groupBy('app_date')->orderBy('app_date', 'desc')->get();
        return view('admin.appointment.index', compact('myappointment'));
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
            'time_end'=>'required' 
        ]);
        
       $doctor = Doctor::where('user_id',auth()->user()->id)->first();
        $appointment = Appointment::create([
            'doctor_id'=> $doctor->id,
            'app_date'=> $request->app_date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);
        
        //foreach($request->time as $time){
        //    Time::create([
        //        'appointment_id'=>$appointment->id,
        //        'time'=> $time,
        //    ]);
        //}
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

        $appointment->update($data);
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
    }
    public function check(Request $request){
        $date = $request->app_date;

        $hasAppointment = Appointment::where('app_date', $date)->where('user_id',auth()->user()->id)->first();
        if (!$hasAppointment) {
            return redirect()->to('/appointment')->with('errmessage','Appointment time not available for this particular date');       
        }
        //$appointmentID= $appointment->id;
        //$times = Time::where('appointment_id',$appointmentID)->get();
        $appointment = Appointment::where('app_date', $date)->where('user_id',auth()->user()->id)->get();

        return view('admin.appointment.index', compact('appointment','date'));
    }
    
    public function updateTime(Request $request){
        $appointmentID = $request->appointmentID;
        $appointment = Time::where('appointment_id',$appointmentID)->delete();
       // foreach($request->time as $time){
        //    Time::create([
       //         'appointment_id'=>$appointmentID,
                //'time'=>$time,
                //'status'=>0,
        //    ]);
       // }
        return redirect()->route('appointment.index')->with('message','Appointment Time Updated');
    }
}
