<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\About;
use App\Models\Prescription;
class DashboardController extends Controller
{   
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $doctor_id;
        if (Auth::user()->role->name=="patient") {
            return view('home');
        }
        if (Auth::user()->role->name=="doctor") {
            $doctor_id = Doctor::where('user_id', auth()->user()->id)->first();
       
            $data = User::select('id', 'created_at')->where('role_id', '4')->get()->groupBy(function($data)
            {
                return Carbon::parse($data->created_at)->format('M Y');
            });

            $months = [];
            $monthCount = [];
            foreach($data as $month => $values){
                $months[]=$month;
                $monthCount[]=count($values);
            }

            $booking = Booking::select('id', 'app_date')->get()->groupBy(function($booking){
                return Carbon::parse($booking->app_date)->format('M Y');
            });
            
            
            $bookMonths =[];
            $bookingCount = [];

            foreach($booking as $month => $values){
                $bookMonths[]=$month;
                $bookingCount[]=count($values);
            }
        return view ('dashboard', compact('data','months','monthCount','booking','bookMonths','bookingCount','doctor_id'));
        }
        else{
            $data = User::select('id', 'created_at')->where('role_id', '4')->get()->groupBy(function($data)
            {
                return Carbon::parse($data->created_at)->format('M Y');
            });

            $months = [];
            $monthCount = [];
            foreach($data as $month => $values){
                $months[]=$month;
                $monthCount[]=count($values);
            }

            $booking = Booking::select('id', 'app_date')->get()->groupBy(function($booking){
                return Carbon::parse($booking->app_date)->format('M Y');
            });
            
            
            $bookMonths =[];
            $bookingCount = [];

            foreach($booking as $month => $values){
                $bookMonths[]=$month;
                $bookingCount[]=count($values);
            }
        return view ('dashboard', compact('data','months','monthCount','booking','bookMonths','bookingCount'));
        }
    }
    public function aboutUS()
    {
        $about = About::latest('created_at')->first();
        return view('admin.layouts.about', compact('about'));
    }
    public function aboutSubmit(Request $request)
    {
        // $data = DB::insert('about')->insert(['description' => $request->about]);
       
        About::create(['description'=> $request->about]);
        return redirect()->back()->with('message','Added successfully');
    }
}
