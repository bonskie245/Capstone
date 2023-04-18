@extends('layouts.master')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    @if(!$booking->doctor->user->user_image)
                    <img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @else
                    <img src="{{asset('images')}}/{{$booking->doctor->user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @endif
                    <br>
                    <p>Name: {{ucfirst($booking->doctor->user->user_fName)}} {{ucfirst($booking->doctor->user->user_lName)}}</p>
                    <p>Gender: {{ucfirst($booking->doctor->user->user_gender)}}</p>
                    <p>Specialize: {{$booking->doctor->user->user_department}}</p>
                    
                    
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

            <form action="{{route('booking.updateTime',[$booking->id])}}" method="post">@csrf 
            @method('PUT') 
            <div class="card">
                <div class="card-header"><strong><h2>Edit Time</h2></strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="datepickers" id="datepicker_label"><h4>Pick a Date: </h4></label>          
                                <div id="datepickers" ></div>
                                <!-- <label for="alternate" id="date_label"><h4>Date: </h4></label>  -->                 
                        </div>
                    </div>
                            <input type="text" name="booking_id" value="{{$booking->id}}">
                            <input type="text" name="appID" value="{{$appID}}">
                <div class="row">
                        <div class="form-group col-md-12">
                            <label for="alternate"> <h3>Available Time for: </h3> </label>
                            <input type="hidden" name="doctorId" id="doctorID" value="{{$booking->doctor_id}}">
                            <input type="text" id="alternate" name="app_date" size="20" class="no-outline">
                        </div>
                </div>
                <div class="row"id="result">                     
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
<style>
     .flex-container{display: flex;justify-content: space-around;background:#fff;}
  div.ui-datepicker{
    width: 100% !important;
    line-height: 1;
    text-align: center;
  }
</style>
   
@endsection