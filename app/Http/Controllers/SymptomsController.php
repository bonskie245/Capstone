<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptoms;

class SymptomsController extends Controller
{
    //
    public function create()
    {
        return view('symptoms.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        Symptoms::create($data);
        return redirect()->back()->with('message', 'Added Successfully');
    }
}
