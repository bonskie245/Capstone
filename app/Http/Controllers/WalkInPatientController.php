<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\WalkIn_Patient;


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
        date_default_timezone_set('Asia/Manila');
       // $request->validate(['time'=>'required']);
        
        $check = $this->checkBookingTimeInterval($request->doctorId,$request->user_id, $request->app_date);
        
        if($check){
            return redirect()->back()->with('errmessage','You already made an Appointment for today. Please wait tomorrow to make next appointment');
        }

        /*Create Booking*/
        $booking = Booking::create([
                'app_id'=> $request->app_id,
                'user_id'=>$request->user_id,
                'doctor_id' => $request->doctorId,
                'app_date' => $request->app_date,
                'book_status'=> 0
        ]);

        if($booking){
            Appointment::where('id',$request->app_id)
                        ->update(['app_status' => 1]);
        }

        return redirect()->back()->with('message','Your appointment is Booked Succesfully');
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

    public function appointment($id)
    {
         date_default_timezone_set('Asia/Manila');
        
         $users = User::find($id);

        if(request('app_date'))
        {
            $doctors= $this->findDoctorsBasedOnDate(request('app_date'));
            $date = request('app_date');
            return view('admin.walkInAppointment.appointment',compact('doctors','date','users'));
        }
          $date = date('Y-m-d');
          $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
          return view('admin.walkInAppointment.appointment',compact('doctors','date','users'));
    }
    
    public function findDoctorsBasedOnDate($date)
    {
        $doctors = Appointment::where('app_date', $date)->groupBy('doctor_id')->get();
        return $doctors;
    }

    public function showTime($doctorId,$date,$id)
    {
        $appointments = Appointment::where('doctor_id',$doctorId)->where('app_date',$date)->where('app_status',0)->orderBy('time_start')->get();

        $users = User::find($id);
        $doctor = Doctor::where('id',$doctorId)->first();
        $doctor_id = $doctorId;

        return view('admin.walkInAppointment.showTime',compact('date','doctor','doctor_id','appointments','users'));
    }

    public function checkBookingTimeInterval($doctorId,$userid,$date)
    {
        return Booking::orderby('id','desc')
        ->where('user_id',$userid)
        ->where('doctor_id',$doctorId)
        ->whereDate('app_date', $date)
        ->exists();
    }

}
