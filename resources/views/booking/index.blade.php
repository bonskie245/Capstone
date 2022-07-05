@extends('layouts.app')

@section('content')
  <div class="container">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 <h5>{{Session::get('message')}}</h5>
                                </div>
                            @endif
                            @if(Session::has('errmessage'))
                                <div class="alert alert-danger">
                                 <h5>{{Session::get('errmessage')}}</h5>
                                </div>
                            @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>My appointments ({{$bookings->count()}})</h2></div>
                <div class="card-body">
                   <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"  style="font-size: 20px;">#</th>
                          <th scope="col"  style="font-size: 20px;">Doctor</th>
                          <th scope="col"  style="font-size: 20px;">Time</th>
                          <th scope="col"  style="font-size: 20px;">Date for</th>
                          <th scope="col"  style="font-size: 20px;">Status</th> 
                          <th class="nosort">&nbsp;</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key => $booking)
                        <tr>
                          <th scope="row"  style="font-size: 16px;">{{$key+1}}</th>
                          <td style="font-size: 16px;">Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                            @foreach($booking->appointment as $book)
                              <td style="font-size: 16px;">{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</td>
                              <td style="font-size: 16px;">{{date('F j, Y', strtotime($book->app_date))}}</td>
                            @endforeach
                          <td>
                              
                                @if($booking->book_status==0)
                                <button style="color:grey; border: none; font-size: 16px;">Pending</button>
                                @endif
                                @if($booking->book_status==1)
                                <button style="color:green; border: none; font-size: 16px;">Appointment Accepted</button>
                                @endif
                                @if($booking->book_status==2)
                                <button style="color:red; border: none; font-size: 16px;">Appointment Declined</button>
                                @endif
                                @if($booking->book_status==3)
                                <button style="color:blue; border: none; font-size: 16px;">Visited</button>
                                @endif
                                @if($booking->book_status==4)
                                <button style="color:red; border: none; font-size: 16px; ">Did not Visit</button>
                                @endif
                          </td>
                          
                          <td>
                            <div class="table-actions">
                                      <a href="{{route('booking.showDoctor',[$booking->id])}}" style="font-size: 16px;"><i class="fa fa-edit" style="color:green">Edit Booking</i></a>
                                      <!-- <form action="{{route('booking.deleteBooking',[$booking->id])}}" method="POST">@csrf
                                      @method('DELETE') -->
                                      <a href="{{route('booking.delete',[$booking->id])}}" style="font-size: 16px;"><i class="fa fa-trash" style="color:red">Cancel Booking</i></button>
                                      <!-- </form> -->
                            </div>
                            <td></td>
                        </td>
                        </tr>
                        
                        @empty
                        <td>You have no any appointment</td>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
