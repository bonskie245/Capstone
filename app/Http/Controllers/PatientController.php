<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prescription;
use File;
use App\Models\PrescriptionMedicines;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //role 1 = admin
        //role 2 = doctor
        //rople 3 = receptionist
        //role 4 = patient
        $users  = User::where('role_id','!=',2)
        ->where('role_id','!=',3)
        ->where('role_id','!=',1)
        ->paginate(10);
        return view('patient.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        if($request->hasFile('user_image')){
        $name = (new User)->patientAvatar($request);
        $data['user_image'] = $name;
        }
        
        $data['password'] = bcrypt($request->password);
        User::create($data);
        
        return redirect()->back()->with('message','Patient Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('patient.delete',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('patient.edit',compact('users'));
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
        $this->validateUpdate($request,$id);
        $data = $request->all();
        $user = User::find($id);
        $imageName = $user->user_image;
        $userPassword = $user->password;
        
        if ($request->hasFile('user_image')) {
            $imageName = (new User)->patientAvatar($request);
            File::delete(public_path('profiles/'.$user->user_image));
        }
        $data['user_image']= $imageName;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        else{
            $data['password'] = $userPassword;
        }
            $user->update($data);
            return redirect()->route('patient.index')->with('message','Patient updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $userDelete = $user->delete();
        if($userDelete){
             File::delete(public_path('profiles/'.$user->user_image));
        }
        return redirect()->route('patient.index')->with('message','Patient Deleted Succesfully');
    }

    public function showHistory($id)
    {
        $user = User::where('id', $id)->first();
        $prescriptions = Prescription::where('user_id', $id)->orderBy('app_date', 'desc')->paginate(5);
        return view('patient.showMedical', compact('prescriptions', 'user'));
        
    }
    
    public function showPrescription($userID, $date)
    {
        $prescription1 = Prescription::where('user_id', $userID)->where('app_date', $date)->first();
        $prescriptions = PrescriptionMedicines::where('prescription_id', $prescription1->id)->get();
       return view('patient.showPrescription',compact('prescriptions', 'prescription1'));
    }
    public function validateStore($request)
    {
        return $request->validate([
        'user_fName'=>'required',
        'user_lName'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:6|max:12',
        'user_phoneNum'=>'required|numeric',
        'user_address'=>'required',
        'user_gender'=>'required',  
        ]);     
    }
    public function validateUpdate($request,$id)
    {
        return $request->validate([
        'user_fName'=>'required',
        'user_lName'=>'required',
        'email'=>'required|unique:users,email,'.$id,
        'role_id'=>'required',
        'user_phoneNum'=>'required|numeric',
        'user_address'=>'required',
        'user_gender'=>'required',  
        ]);     
    }
}
