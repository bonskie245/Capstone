@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Booking</h5>
                        <span>Appointment Today</span>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
        </div>
    </div>
<div class="container">
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
    <div class="row justify-content-center">
    <div class="container">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments today ({{$bookings->count()}})</div></strong>
                <div class="card-header">
                        <h3>Today is <strong>{{ date('F j, Y') }}</strong></h3>
                </div>
            </div>
            <!-- Container -->

            <div class="card-columns">
                @foreach($bookings as $key => $booking)
                @foreach($booking->user as $user)
                <div class="card" style="width: 300px;">
                                @if(!$user->user_image)
                                <img src="{{asset("/images/user.png")}}" class="card-img-top" style="width: 150px; border-radius: 100%; display: block; margin-left: auto; margin-right: auto; margin-top: 20px; height: 150px;">
                                @else
                                <img class="card-img-top" src="{{asset('profiles')}}/{{$user->user_image}}" style="width: 150px; border-radius: 100%; display: block; margin-left: auto; margin-right: auto; margin-top: 20px;  height: 150px;">
                                @endif
                        <div class="card-body">
                            <hr>
                        <h5 class="card-title text-center"><strong>{{$user->user_fName}} {{$user->user_lName}}</strong></h5> 
                        <p class="card-text"><strong>Cellphone #:</strong> {{$user->user_phoneNum}}</p>
                        @endforeach
                        @foreach($booking->appointment as $book)
                        <p class="card-text"><strong>Appointment date: </strong>{{$book->app_date}}</p>
                        <p class="card-text"><strong>Appointment time: </strong>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</p>
                        <p class="card-text"><strong>Name of Doctor: </strong>Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}, {{$booking->doctor->doctor_title}}</p>
                        @endforeach 
                        <div class="card-footer text-center">
                                        @if($booking->book_status==0)
                                        <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Accept</button></a>
                                        <a href="{{route('decline.status',[$booking->id])}}"><button class="btn btn-danger">Decline</button></a>
                                        @endif
                                        @if($booking->book_status==1)
                                        <a href="{{route('visited.status',[$booking->id])}}"><button class="btn btn-success">Visited</button></a>
                                        <a href="{{route('notVisited.status',[$booking->id])}}"><button class="btn btn-danger">Not Visited</button></a>
                                        @endif
                                        @if($booking->book_status==2)
                                        <button class="btn btn-danger" style ="background-color:#47ceff;">Visited</button>
                                        @endif
                                        @if($booking->book_status==3)
                                        <button class="btn btn-danger" style ="background-color:#eb095c;">Not Visited</button>
                                        @endif
                                        @if($booking->book_status==4)
                                        <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Declined</button></a>
                                        <button class="btn btn-danger" style ="background-color:#eb095c;">Declined</button>
                                        @endif
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
            </div>
            <!-- end contrainer -->
    </div>
</div>
<!-- <div class="card-deck">
                    @foreach($bookings as $key => $booking)
                    @foreach($booking->user as $user)
                        <div class="card" >
                            <div class="card-header">
                                @if(!$user->user_image)
                                <img src="{{asset("/images/user.png")}}" style="width: 150px; border-radius: 100%; display: block; margin-left: auto; margin-right: auto; height: 150px;">
                                @else
                                <img src="{{asset('profiles')}}/{{$user->user_image}}" style="width: 150px; border-radius: 100%; display: block;margin-left: auto;margin-right: auto; height: 150px;">
                                @endif
                            </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{$user->user_fName}} {{$user->user_lName}}</p>
                                    <p><strong>Cellphone #:</strong> {{$user->user_phoneNum}}</p>
                                    @endforeach
                                        @foreach($booking->appointment as $book)
                                        <p><strong>Appointment date: </strong>{{$book->app_date}}</p>
                                        <p><strong>Appointment time: </strong>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</p>
                                        @endforeach
                                   
                                    <p><strong>Doctor: </strong>Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}, {{$booking->doctor->doctor_title}}</p>
                                       <hr>
                                    <div class="button-group" style="display: inline-block; margin-left: 120px;">
                                        @if($booking->book_status==0)
                                        <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Accept</button></a>
                                        <a href="{{route('decline.status',[$booking->id])}}"><button class="btn btn-danger">Decline</button></a>
                                        @endif
                                        @if($booking->book_status==1)
                                        <a href="{{route('visited.status',[$booking->id])}}"><button class="btn btn-success">Visited</button></a>
                                        <a href="{{route('notVisited.status',[$booking->id])}}"><button class="btn btn-danger">Not Visited</button></a>
                                        @endif
                                        @if($booking->book_status==2)
                                        <button class="btn btn-danger" style ="background-color:#47ceff;">Visited</button>
                                        @endif
                                        @if($booking->book_status==3)
                                        <button class="btn btn-danger" style ="background-color:#eb095c;">Not Visited</button>
                                        @endif
                                        @if($booking->book_status==4)
                                        <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Declined</button></a>
                                        <button class="btn btn-danger" style ="background-color:#eb095c;">Declined</button>
                                        @endif
                                    </div>
                                </div>
                            
                        </div> 
                    </div>
                  
                </div>
                @endforeach -->
@endsection
