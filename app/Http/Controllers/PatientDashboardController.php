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

class PatientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        // if(request('date'))
        // {          
        //     $doctors= $this->findDoctorsBasedOnDate(request('date'),request('doctorId'));
        //     $date = request('app_date');
        //     dd($request->date);
        //     return response()->json($doctors);
        //     // return view('bookapp',compact('doctors','date'));
        // }
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
       
          return view('bookapp',compact('doctors','date','dates'));
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function profile()
    {
        return view('user-profile');
    }

    public function getTimeSlot($date, $id)
    {
        $doctors= $this->findDoctorsBasedOnDate($date,$id);
        return response()->json($doctors);
    }

    public function findDoctorsBasedOnDate($date, $id)
    {
        // $doctors = Appointment::where('app_date', $date)->groupBy('doctor_id')->get();
        $doctors = Appointment::where('app_date', $date)->where('doctor_id', $id)->where('app_status', 0)->get();
        return $doctors;
    }

    public function checkBookingTimeInterval($doctorId,$date)
    {
        return Booking::where('user_id',auth()->user()->id)
        ->where('doctor_id',$doctorId)
        ->whereDate('app_date', $date)
        ->exists();
    }
    
}
