@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">User Profile</div>

                <div class="card-body">
                    <p>First Name: {{auth()->user()->user_fName}}</p>
                    <p>Last Name: {{auth()->user()->user_lName}}</p>
                    <p>Email: {{auth()->user()->user_email}}</p>
                    <p>Address: {{auth()->user()->user_address}}</p>
                    <p>Phone Number: {{auth()->user()->user_phoneNum}}</p>
                    <p>Gender: {{auth()->user()->user_gender}}</p>

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Update Profile</div>

                <div class="card-body">
                    <form action="{{route('profile.store')}}" method="post"> @csrf
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="user_fName" class="form-control @error('fName') is-invalid @enderror"  value="{{auth()->user()->fName}}">
                            @error('fName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="user_lName" class="form-control @error('lName') is-invalid @enderror" value="{{auth()->user()->lName}}">
                            @error('lName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="user_address" class="form-control" value="{{auth()->user()->address}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="user_phoneNum" class="form-control" value="{{auth()->user()->phoneNum}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Gender</label>
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
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Update Image</div>
                <form action="{{route('profile.pic')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    <br>
                    @if(!auth()->user()->user_image)
                    <img src="{{asset("/images/user.png")}}" width="140">
                    @else
                    <br>
                    <img src="{{asset('profiles')}}/{{auth()->user()->user_image}}" style="display: block; margin-left: auto; margin-top: -50px;  margin-right: auto; width: 75%;">
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
