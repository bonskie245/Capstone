<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Prescription;
class PrescriptionController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        $bookings = Booking::where('date',date('Y-m-d'))->where('status', 1)->where('doctor_id', auth()->user()->id)->get();

        return view('prescription.index', compact('bookings'));
    }
    public function store(Request $request)
    {
        $data = $request-> all();
        $data['medicine_name'] = implode(',', $request->medicine_name);
        Prescription::create($data);
        return redirect()->back()->with('message','Prescription Created');
    }
}
