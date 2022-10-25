@extends('layouts.master')

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
                <div class="card-header"><h2>My Bookings ({{$bookings->count()}})</h2></div>
                <div class="card-body">
                   <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col"  style="font-size: 16px;">#</th>
                          <th scope="col"  style="font-size: 16px;">Image</th>
                          <th scope="col"  style="font-size: 16px;">Doctor</th>
                          <th scope="col"  style="font-size: 16px;">Time</th>
                          <th scope="col"  style="font-size: 16px;">Date for</th>
                          <th scope="col"  style="font-size: 16px;">Status</th> 
                          <th scope="col" style="font-size: 16px;">Action</th>
                          <th scope="col"></th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key => $booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          @if(!$doctor->user->user_image)
                          <img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 100%; display: block; margin: 0 auto;">
                          @else
                          <td><img src="{{asset('images')}}/{{$booking->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                          @endif
                          
                          <td >Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                            @foreach($booking->appointment as $book)
                              <td>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</td>
                              <td>{{date('F j, Y', strtotime($book->app_date))}}</td>
                            @endforeach
                          <td>
                              
                                @if($booking->book_status==0)
                               <span class="badge badge-pill badge-secondary mb-1">Pending</span>
                                @endif
                                @if($booking->book_status==1)
                                <span class="badge badge-pill badge-success mb-1">Appointment Accepted</span>
                                @endif
                                @if($booking->book_status==2)
                                <span class="badge badge-pill badge-primary mb-1">Visited</span>
                                @endif
                                @if($booking->book_status==3)
                                <span class="badge badge-pill badge-warning mb-1">Did not Visit</span>
                                @endif
                                @if($booking->book_status==4)
                                <span class="badge badge-pill badge-danger mb-1">Appointment Declined</span>
                                @endif
                          </td>

                          <td>
                          <div class="table-actions">
                            @if($booking->book_status==0)
                                      <a href="{{route('booking.showDoctor',[$booking->id])}}" style="font-size: 12px;"><i class="fa fa-edit" style="color:green">Edit Booking</i></a>
                            @endif
                            @if($booking->book_status!=2)
                                      <!-- <form action="{{route('booking.deleteBooking',[$booking->id])}}" method="POST">@csrf
                                      @method('DELETE') -->
                                      <a href="{{route('booking.delete',[$booking->id])}}" style="font-size: 12px;"><i class="fa fa-trash" style="color:red">Cancel Booking</i></button>
                                      <!-- </form> -->
                            @endif
                            </div>
                            <td></td>
                        </td>
                        </tr>
                        
                        @empty
                        <td>You have no any appointment</td>
                        @endforelse
                      </tbody>
                    </table>
                    {{$bookings->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
