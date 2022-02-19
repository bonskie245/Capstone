<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
{
    public function index()
    {

     $users  = User::where('role_id','!=',4)
                    ->where('role_id','!=',3)
                    ->where('role_id','!=',1)
                    ->get();
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

        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        User::create($data);
        
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
        $imageName = $user->image;
        $userPassword = $user->password;
        
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            File::delete(public_path('images/'.$user->image));
        }
        $data['image']= $imageName;
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
             File::delete(public_path('images/'.$user->image));
        }
        return redirect()->route('doctor.index')->with('message','Doctor Deleted Succesfully');
    }
    public function validateStore($request)
    {
        return $request->validate([
        'fName'=>'required',
        'lName'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:6|max:12',
        'role_id'=>'required',
        'phoneNum'=>'required|numeric',
        'address'=>'required',
        'department'=>'required',
        'image'=>'required|mimes:jpeg,jpg,png',
        'gender'=>'required',  
        ]);     
    }
     public function validateUpdate($request,$id)
    {
        return $request->validate([
        'fName'=>'required',
        'lName'=>'required',
        'email'=>'required|unique:users,email,'.$id,
        'role_id'=>'required',
        'phoneNum'=>'required|numeric',
        'address'=>'required',
        'department'=>'required',
        'image'=>'mimes:jpeg,jpg,png',
        'gender'=>'required',  
        ]);     
    }
}
