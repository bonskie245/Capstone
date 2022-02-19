@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    <img src="{{asset('images')}}/{{$user->image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    <br>
                    <p class="lead">Name: {{ucfirst($user->fName)}} {{ucfirst($user->lName)}}</p>
                    <p class="lead">Gender: {{ucfirst($user->gender)}}</p>
                    <p class="lead">Specialize: {{$user->department}}</p>
                    
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
                <div class="card-header"><strong><h2>Time available on {{$date}}</h2></strong></div>
                <div class="card-body">
                    <div class="row">
                        @foreach($times as $time)
                        <div class="col-md-3">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="time" value="{{$time->time}}"> 
                                <span>{{$time->time}}</span>
                            </label>
                        </div>
                        <input type="hidden" name="doctorId" value="{{$doctor_id}}">
                        <input type="hidden" name="appointmentId" value="{{$time->appointment_id}}">
                        <input type="hidden" name="date" value="{{$date}}">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                @if(Auth::check())
                <button type="submit" class="btn btn-success" style="width: 150px">Book Appointment</button>
                <a href="{{ url('/')}}"><button class="btn btn-secondary" style="width: 150px">Cancel</button></a>
                @else
                    <p>Please login to make an appointment</p>
                    <a href="{{route('login')}}" class="btn btn-primary">Login</a>
                    <a href="{{route('register')}}" class="btn btn-secondary">Register</a>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
