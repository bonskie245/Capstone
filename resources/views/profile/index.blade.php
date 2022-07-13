@extends('layouts.master')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><h2>User Profile</h2></div>

                <div class="card-body">
                    <p><b>First Name:</b> {{auth()->user()->user_fName}}</p>
                    <p><b>Last Name:</b> {{auth()->user()->user_lName}}</p>
                    <p><b>Email:</b> {{auth()->user()->email}}</p>
                    <p><b>Address:</b> {{auth()->user()->user_address}}</p>
                    <p><b>Phone Number:</b> {{auth()->user()->user_phoneNum}}</p>
                    <p><b>Gender:</b> {{auth()->user()->user_gender}}</p>
                    <p><b>Birtdate:</b> {{auth()->user()->user_birthdate}}</p>
                    <p><b>Age:</b> {{\Carbon\Carbon::parse(auth()->user()->user_birthdate)->age}}</p>

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h2>Update Profile</h2></div>

                <div class="card-body">
                    <form action="{{route('profile.store')}}" method="post"> @csrf
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="user_fName" class="form-control @error('user_fName') is-invalid @enderror"  value="{{auth()->user()->user_fName}}">
                            @error('user_fName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="user_lName" class="form-control @error('user_lName') is-invalid @enderror" value="{{auth()->user()->user_lName}}">
                            @error('user_lName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="user_address" class="form-control" value="{{auth()->user()->user_address}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="user_phoneNum" class="form-control" value="{{auth()->user()->user_phoneNum}}">
                        </div>
                        <br>
                        <label>Gender</label>
                        <div class="form-group">
                            
                            <select name="user_gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="male" @if(auth()->user()->user_gender==='male')selected @endif>Male</option>
                                <option value="female" @if(auth()->user()->user_gender==='female')selected @endif>Female</option>
                            </select>
                                 @error('user_gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                 @enderror
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h2>Update Profile Picture</h2></div>
                <form action="{{route('profile.pic')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    <br>
                    @if(!auth()->user()->user_image)
                    <img src="{{asset("/images/user.png")}}" style="display: block; margin-left: auto; margin-top: -50px;  margin-right: auto;" width="150"  height="150">
                    @else
                    <br>
                    <img src="{{asset('profiles')}}/{{auth()->user()->user_image}}" style="display: block; margin-left: auto; margin-top: -50px;  margin-right: auto;" width="150"  height="150">
                    @endif
                    <input type="file" name="file" class="form-control" required="">
                    @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
