@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    @if(!$doctor->user->user_image)
                    <img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @else
                    <img src="{{asset('images')}}/{{$doctor->user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @endif
                    <br>
                    <p>Name: {{ucfirst($doctor->user->user_fName)}} {{ucfirst($doctor->user->user_lName)}}</p>
                    <p>Gender: {{ucfirst($doctor->user->user_gender)}}</p>
                    <p>Specialize: {{$doctor->user->user_department}}</p>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

             @if(Session::has('errmessage'))
                <div class="alert alert-danger">
                    {{Session::get('errmessage')}}
                </div>
            @endif

            <form action="{{route('booking.appointment')}}" method="post">@csrf 
            <div class="card">
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
                        @empty
                        <p style="color: red;">&emsp;All slot are allocated</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <p><label for="w3review">Reason for Booking </label></p>
                <textarea id="w3review" name="book_reason" rows="4" cols="100"></textarea>
                </div>
            </div>
            <div class="card-footer bg-white">
                @if(Auth::check())
                    <button type="submit" class="btn btn-primary" style="width:170px;">Book Appointment</button>
                    <a href="{{route('users.create')}}" class="btn btn-secondary">Cancel</a>
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
</div>
@endsection
