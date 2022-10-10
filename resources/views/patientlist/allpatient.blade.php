@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
            

                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Booking</h5>
                        <span>All time Booking</span>
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>
                <form action="{{route('all.appointments')}}" method="GET">
                

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
              <div class="card-header">
                Search by date:
                        <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker2" data-toggle="datetimepicker" data-target="#datepicker2" name="app_date">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </div>   
                    </form>

                        
                </div>
                <div class="card-body">
                   <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Reason</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Time</th>
                          <th scope="col">Date</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Action</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key =>$booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          @foreach($booking->user as $user)
                          @if(!$user->user_image)
                          <td><img src="{{asset('images/user.png')}}"
                              width="80px "  height="80px" style="border-radius: 50%;"></td>
                          @else
                            <td><img src="{{asset('profiles')}}/{{$user->user_image}}"
                              width="80px "  height="80px" style="border-radius: 50%;"></td>
                          @endif
                              <td>{{$user->user_lName}} ,  {{$user->user_fName}}</td>
                          
                          
                              @if(!$booking->book_reason)
                              <td>Did not indicate reason</td>
                              @else
                                <td>{{$booking->book_reason}}</td>
                             @endif
                          <td>{{$user->user_phoneNum}}</td>
                          @endforeach
                              @foreach($booking->appointment as $book)
                              <td>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</td>
                              <td>{{date('F j, Y', strtotime($book->app_date))}}</td>
                             @endforeach
                          <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                                @if($booking->book_status==0)
                                <td><a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Accept</button></a></td>
                                <td><a href="{{route('decline.status',[$booking->id])}}"><button class="btn btn-danger">Decline</button></a></td>
                                @endif
                                @if($booking->book_status==1)
                                <td><a href="{{route('visited.status',[$booking->id])}}"><button class="btn btn-success">Visited</button></a></td>
                                <td><a href="{{route('notVisited.status',[$booking->id])}}"><button class="btn btn-danger">Not Visited</button></a></td>
                                @endif
                                @if($booking->book_status==2)
                                <td><button class="btn btn-danger" style ="background-color:#47ceff;">Visited</button></td>
                                <td></td>
                                @endif
                                @if($booking->book_status==3)
                                <td><button class="btn btn-danger" style ="background-color:#eb095c;">Not Visited</button></td>
                                <td></td>

                                @endif
                                @if($booking->book_status==4)
                                <td><a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Undo</button></a></td>
                                <td><button class="btn btn-danger" style ="background-color:#eb095c;">Declined</button></td>
                                @endif
                        </tr>
                        @empty
                        <td>No appointments Today</td>
                        @endforelse
                        
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
            {!! $bookings->onEachSide(5)->links() !!}
            </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
