@extends('admin.layouts.master')

@section('content')
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
                <form action="{{route('patient')}}" method="GET">
                <div class="card-header">
                    
                Search by date:
                        <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="app_date">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </div>   
                    </form>
                </div>
                <div class="card-body">
                   <table id="data_table" class="table">
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
                                <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-success">Visited</button></a>
                                <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-danger">Not Visited</button></a>
                                @endif
                                @if($booking->book_status==2)
                                <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-danger">Declined</button></a>

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
