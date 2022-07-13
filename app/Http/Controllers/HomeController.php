<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role->name=="admin"||Auth::user()->role->name=="doctor"||Auth::user()->role->name=="receptionist"){
            return redirect()->to('/dashboard/admin');
        }
        elseif(Auth::user()->role->name=="patient"){
            return redirect()->to('/dashboard/users')->with('message','Welcome to Urgent Care Clinic ' . Auth::user()->user_lName);;
        }
        return view('home');
    }
}