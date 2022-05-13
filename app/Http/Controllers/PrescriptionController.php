<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Prescription;
use App\Models\Doctor;

class PrescriptionController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorID = Doctor::where('user_id', auth()->user()->id)->first();
        $bookings = Booking::where('app_date',date('Y-m-d'))->where('book_status', 1)->where('doctor_id', $doctorID->id)->get();

        return view('prescription.index', compact('bookings', 'doctorID'));
    }

    public function create(){
        return view('prescription.create');
    }

    public function store(Request $request)
    {
        $data = $request-> all();
        
        foreach ($request->addmore as $key => $value) {
            //Code Here
        }

        Prescription::create($data);
        return redirect()->back()->with('message','Prescription Created');
    }
    
    public function show($userID, $date)
    {
        $prescription = Prescription::where('user_id', $userID)->where('app_date', $date)->first();
       return view('prescription.show',compact('prescription'));
    }

    public function prescribedPatient()
    {
        $patients = Prescription::get();
        return view('prescription.all', compact('patients'));
    }
}
