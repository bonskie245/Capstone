<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{   
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->role->name=="patient") {
            return view('home');
        }
            $data = User::select('id', 'created_at')->where('role_id', '4')->get()->groupBy(function($data)
            {
                return Carbon::parse($data->created_at)->format('M');
            });
            $months = [];
            $monthCount = [];
            foreach($data as $month => $values){
                $months[]=$month;
                $monthCount[]=count($values);
            }

            $booking = Booking::select('id', 'created_at')->get()->groupBy(function($booking){
                return Carbon::parse($booking->created_at)->format('M');
            });

            $bookMonths =[];
            $bookingCount = [];

            foreach($booking as $month => $values){
                $bookMonths[]=$month;
                $bookingCount[]=count($values);
            }

            // $users = User::select(DB::raw("COUNT(*) as count"))
            //         ->whereYear('created_at', date('Y'))
            //         ->groupBy(DB::raw("MONTH(created_at)"))
            //         ->pluck('count');
            // $months = User::select(DB::raw("Month(created_at) as month"))
            //         ->whereYear('created_at', date('Y'))
            //         ->groupBy(DB::raw("MONTH(created_at)"))
            //         ->pluck('month');
            

        return view ('dashboard', compact('data','months','monthCount','booking','bookMonths','bookingCount'));
    }
}
