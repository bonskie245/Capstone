@extends('layouts.app')

@section('content')
<div class="container">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"><h1>My appointments ({{$bookings->count()}})</h1></div>
                <div class="card-body">
                   <table id="data_table" class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Time</th>
                          <th scope="col">Date for</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                          <th scope="row"></th>
                          <td>Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                            @foreach($booking->appointment as $book)
                              <td>{{date('h:i A', strtotime($book->time_start))}} - {{date('h:i A', strtotime($book->time_end))}}</td>
                              <td>{{date('F j, Y', strtotime($book->app_date))}}</td>
                            @endforeach
                          <td>
                              
                                @if($booking->book_status==0)
                                <button class="btn btn-secondary">Pending</button>
                                @endif
                                @if($booking->book_status==1)
                                <button class="btn btn-success">Appointment Accepted</button>
                                @endif
                                @if($booking->book_status==2)
                                <button class="btn btn-danger">Appointment Declined</button>
                                @endif
                                @if($booking->book_status==3)
                                <button class="btn btn-success">Visited</button>
                                @endif
                                @if($booking->book_status==4)
                                <button class="btn btn-success">Did not Visit</button>
                                @endif
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
