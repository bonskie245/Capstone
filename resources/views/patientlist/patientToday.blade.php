@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
            

                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Booking</h5>
                        <span>Booking Calendar</span>
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
        <div class="col-md-14">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>

                <div class="card-header">
                        <h3>Date Today: <strong>{{ date('F j, Y') }}</strong></h3>
                </div>
                <div class="card-body">
                   <table  class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Date</th>
                          <th scope="col">Time</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Status</th>
                          <th class="nosort">&nbsp;</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key => $booking)
                        <tr>
                          <th scope="row">{{$key +1}}</th>
                          @foreach($booking->user as $user)
                            <td><img src="{{asset('profiles')}}/{{$user->user_image}}"
                            width="80px "  height="80px"style="border-radius: 50%;"></td>
                            <td>{{$user->user_lName}} ,  {{$user->user_fName}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->user_phoneNum}}</td>
                          @endforeach
                              @foreach($booking->appointment as $book)
                              <td>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</td>
                              <td>{{date('F j, Y', strtotime($book->app_date))}}</td>
                             @endforeach
                          <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                          <td>
      
                              
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
                          </td>
                        </tr>
                        @empty
                        <td>No appointments Today</td>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
