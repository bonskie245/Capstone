<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_fName'=>'required',
            'user_lName'=>'required',
            'user_address'=>'required',
            'user_phoneNum'=>'required',
            'user_gender'=>'required'

        ]);
            User::where('id',auth()->user()->id)
                ->update($request->except('_token'));
            return redirect()->back()->with('message','Profile Updated');
    }
    public function profilePic(Request $request)
    {
        $this->validate($request,['file'=>'required|image|mimes:jpeg,png,jpg']);
        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('/profiles');
            $image->move($destination,$name);

            $user= User::where('id',auth()->user()->id)->update(['user_image'=>$name]);

            return redirect()->back()->with('message','Profile Updated');
        }
    }
    public function updatePassword(Request $request)
    {
            # Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);


            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("errmessage", "Old Password Doesn't match!");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->back()->with('message', 'Password changed successfully!');
    }
}
