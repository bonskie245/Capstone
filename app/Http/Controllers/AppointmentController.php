<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\VacationLeave;
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
        $doctor_id = Doctor::where('user_id', auth()->user()->id)->first();

        $doctorid = $doctor_id->id;
        $vacations = VacationLeave::where('doctor_id', $doctorid)->get();

        return view('admin.appointment.index', compact('vacations'));
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

        
            // Get date Ranges
            $startDate = Carbon::createFromFormat('Y-m-d', $request->app_date)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('Y-m-d', $request->app_date2)->format('Y-m-d');

            $daterange = CarbonPeriod::create($startDate, $endDate);
            $doctor_id = Doctor::where('user_id', auth()->user()->id)->first();

            $doctorid = $doctor_id->id;
    foreach ($daterange as $date) 
    {  
        if(VacationLeave::where('vacation_date', $date)->where('doctor_id', $doctorid)->exists())
        {
            return redirect()->back()->with('errmessage', 'Dates Existed');
        }
        else
        {
            VacationLeave::create([
                'vacation_date' => $date,
                'doctor_id' => $doctorid
            ]);
        }
    }
    return redirect()->route('appointment.create')->with('message', 'Dates has been added');

    
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = VacationLeave::find($id);
        $appointment->delete();
        
        return redirect()->route('appointment.index')->with('message','Appointment Deleted Successfuly');
    }

}
