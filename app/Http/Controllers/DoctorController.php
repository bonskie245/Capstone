<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use File;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
{
    public function index()
    {

     $users  = User::where('role_id','!=',4)
                    ->where('role_id','!=',3)
                    ->where('role_id','!=',1)
                    ->paginate(10);
         return view('admin.doctor.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        return view('admin.doctor.create');

        // date_default_timezone_set('Asia/Manila');
        
        // if(request('app_date')){
        //     $doctors= $this->findDoctorsBasedOnDate(request('app_date'));
        //     $date = request('app_date');
        //     return view('admin.walkInAppointment.create',compact('doctors','date'));
        // }
        // $date = date('Y-m-d');
        //   $doctors = Appointment::where('app_date',date('Y-m-d'))->groupBy('doctor_id')->get();
        //   return view('admin.walkInAppointment.create',compact('doctors','date'));

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
        $name = (new User)->userAvatar($request);

        $data['user_image'] = $name;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        if($user){
            Doctor::create([
                'user_id'=>$user->id,
                'doctor_department'=>$user->user_department,
                'doctor_title' => $request->doctor_title,
            ]);
        }
        return redirect()->back()->with('message','Doctor Added successfully');

       

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
        return view('admin.doctor.delete',compact('user'));
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
        return view('admin.doctor.edit',compact('users'));

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
        
        $doctor = Doctor::where('user_id', $user->id)->update(['doctor_department' => $data['user_department']]);
        
        if($request->hasFile('user_image')) {
            $imageName = (new User)->userAvatar($request);
            File::delete(public_path('images/'.$user->user_image));
        }
        $data['user_image']= $imageName;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        else{
            $data['password'] = $userPassword;
        }
            $user->update($data);
            return redirect()->route('doctor.index')->with('message','Doctor updated Succesfully');

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
             File::delete(public_path('images/'.$user->user_image));
             Doctor::where('user_id',$id)->delete();
        }
        return redirect()->route('doctor.index')->with('message','Doctor Deleted Succesfully');
    }
    public function validateStore($request)
    {
        return $request->validate([
        'user_fName'=>'required',
        'user_lName'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:6|max:12',
        'role_id'=>'required',
        'user_phoneNum'=>'required|numeric',
        'user_address'=>'required',
        'user_department'=>'required',
        'user_image'=>'required|mimes:jpeg,jpg,png',
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
        'user_department'=>'required',
        'user_image'=>'mimes:jpeg,jpg,png',
        'user_gender'=>'required',  
        ]);     
    }
}
