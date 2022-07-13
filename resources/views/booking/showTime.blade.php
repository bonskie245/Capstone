@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    <img src="{{asset('images')}}/{{$doctor->user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    <br>
                    <p class="lead"><b>Name:</b> {{ucfirst($doctor->user->user_fName)}} {{ucfirst($doctor->user->user_lName)}}</p>
                    <p class="lead">Gender: {{ucfirst($doctor->user->user_gender)}}</p>
                    <p class="lead">Specialize: {{$doctor->user->user_department}}</p>
                    
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

            <!-- <div class="card">
                <div class="card-body">{{$appID}}</div>
            </div> -->

            <form action="{{route('booking.updateTime',[$bookings->id])}}" method="POST">@csrf 
            @method('PUT')
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
                        <input type="hidden" name="appID" value="{{$appID}}">
                        @empty
                        <p style="color: red;">&emsp;All slot are allocated</p>
                        @endforelse
                
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-success" style="width: 180px">Book Appointment</button>
                    <a href="{{route('my.booking')}}"><button class="btn btn-success" style="width: 150px">Cancel</button></a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
