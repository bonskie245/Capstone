<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\WalkInApp;
use App\Models\Booking;

class WalkInAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorID = Doctor::where('user_id', auth()->user()->id)->first();
        $bookings = WalkInApp::where('app_date',date('Y-m-d'))->where('doctor_id', $doctorID->id)->orderBy('id', 'desc')->get() ;

        return view('admin.walkIn.index', compact('bookings', 'doctorID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        date_default_timezone_set('Asia/Manila');
        $user = User::find($id);
        $date = date('Y-m-d');
        $doctors = Doctor::all();
        return view('admin.walkin.create', compact('user','doctors','date'));
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
        
        $data = $request->all();
 
        if(Booking::where('user_id', $data['user_id'])->where('doctor_id', $data['doctor_id'])->where('app_date', $data['app_date'])->exists())
        {
            return redirect()->route('patient.index')->with('errmessage', 'You Already have your appoint with that doctor today');
        }
        if(WalkInApp::where('user_id', $data['user_id'])->where('doctor_id', $data['doctor_id'])->where('app_date', $data['app_date'])->exists())
        {
            return redirect()->route('patient.index')->with('errmessage', 'You Already have your appoint with that doctor today');

        }
            WalkInApp::create($data);

        return redirect()->route('patient.index')->with('message', 'Queued succesfully');

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

    public function createPrescription($id,$date,$doctorID)
    {
        // date_default_timezone_set('Asia/Manila');
        $bookings = WalkInApp::where('user_id', $id)->where('app_date', $date)->where('doctor_id', $doctorID)->first();
        return view('admin.walkIn.prescription', compact('bookings'));
    }
}
