<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PatientlistController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if($request->user_date){
             $bookings =Booking::latest()->where('app_date',$request->user_date)->get();
            return view('patientlist.index',compact('bookings'));
        }
            $bookings =Booking::latest()->where('app_date',date('Y-m-d'))->get();
            return view('patientlist.index',compact('bookings'));

    }

    public function acceptStatus($id)
    {
        $booking = Booking::find($id);
        $booking->status =! $booking->status;
        $booking->save();
        return redirect()->back();
    }

   /*public function declineStatus($id)
    {
        $booking = Booking::find($id);
        $booking->status = 1;
        $booking->update(['user_id'=> null]);
        $booking->save();
        return redirect()->back();
    }*/

    public function allTimeAppointment()
    {
        $bookings =Booking::latest()->paginate(20);
            return view('patientlist.index',compact('bookings'));

    }
}
