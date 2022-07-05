@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>Walk-in/Call Patient Appointment</h5>
                            <span>Appointment</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('walkIn.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Doctors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    <img src="{{asset('images')}}/{{$doctor->user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    <br>
                    <p class="lead">Name: {{ucfirst($doctor->user->user_fName)}} {{ucfirst($doctor->user->user_lName)}}</p>
                    <p class="lead">Gender: {{ucfirst($doctor->user->user_gender)}}</p>
                    <p class="lead">Specialize: {{$doctor->user->user_department}}</p>
                    
                </div>
            </div>
        </div>
       
           
            <div class="col-md-9">
                    <form action="{{route('walkIn.store')}}" method="post">@csrf 
                        <div class="card">
                        @foreach($errors->all() as $error)
                        <div class="card-header"> <div class="alert alert-danger">{{$error}}</div><div>
                        @endforeach

                        @if(Session::has('message'))
                        <div class="card-header">
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        </div>
                        @endif

                        @if(Session::has('errmessage'))
                        <div class="card-header">
                            <div class="alert alert-danger">
                                {{Session::get('errmessage')}}
                            </div>
                        </div>
                        @endif
                            <div class="card-header"><strong><h2>Time available on {{date('F j - Y,', strtotime($date))}}</h2></strong></div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse($appointments as $appointment)
                                    <div class="col-md-3">
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="app_id" value="{{$appointment->id}}"> 
                                            <span>{{date('h:i a', strtotime($appointment->time_start))}} - {{date('h:i a', strtotime($appointment->time_end))}}</span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="doctorId" value="{{$doctor_id}}">
                                    <input type="hidden" name="app_date" value="{{$appointment->app_date}}">
                                    <input type="hidden" name="user_id" value="{{$users->id}}">
                                    @empty
                                    <p style="color: red;">&emsp;All slot are allocated</p>
                                    @endforelse
                            
                                </div>
                            </div>
                        </div>
                            <div class="card-footer bg-white">
                                @if(Auth::check())
                                    <button type="submit" class="btn btn-success" style="width: 150px">Book Appointment</button>
                                    <!-- <a href="{{route('welcome')}}"><button class="btn btn-secondary" style="width: 150px">Cancel</button></a> -->
                                @else
                                    <p style="color: red;">Please login to make an appointment</p>
                                    <a href="{{route('login')}}" class="btn btn-primary">Login</a>
                                    <a href="{{route('register')}}" class="btn btn-secondary">Register</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

@endsection