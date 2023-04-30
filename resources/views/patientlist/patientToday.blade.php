@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
            

                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Booking</h5>
                        <span>Booking Today</span>
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
                          <script>
                            Swal.fire({
                              title: 'Success',
                              text: '{{Session::get('message')}}',
                              icon: 'success',
                              confirmButtonText: 'Okay  '
                            })
                          </script>
                    @endif
                    @if(Session::has('errmessage'))
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{Session::get('errmessage')}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endif
                    @foreach($errors->all() as $error)
                        <!-- <div class="alert alert-danger">
                            {{$error}}                        
                        </div>   -->
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{$error}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endforeach
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments</div></strong>

                <div class="card-header">
                        <h3>Date Today: <strong>{{ date('F j, Y') }}</strong></h3>
                </div>
                <div class="card-body">
                        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="true">Pending({{$bookingPending->count()}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-confirmed-tab" data-toggle="pill" href="#pills-confirmed" role="tab" aria-controls="pills-confirmed" aria-selected="false">Confirmed({{$bookingConfirmed->count()}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-declined-tab" data-toggle="pill" href="#pills-declined" role="tab" aria-controls="pills-declined" aria-selected="false">Declined({{$bookingDeclined->count()}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-cancelled-tab" data-toggle="pill" href="#pills-cancelled" role="tab" aria-controls="pills-cancelled" aria-selected="false">Cancelled({{$bookingCancelled->count()}})</a>
                                </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                                <!-- Pending -->
                                <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab" style="overflow-x:auto;">
                                    <table class="table table-hover" >
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
                                                @forelse($bookingPending as $key =>$booking)
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
                                                    <td>{{date('h:i A', strtotime($booking->time_start))}} - {{date('h:i A', strtotime($booking->time_end))}}</td>
                                                    <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>
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
                                                        @endif
                                                        @if($booking->book_status==3)
                                                        <td><button class="btn btn-danger" style ="background-color:#eb095c;">Not Visited</button></td>
                                                        @endif
                                                        @if($booking->book_status==4)
                                                        <td><a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Undo</button></a></td>
                                                        <td><button class="btn btn-danger" style ="background-color:#eb095c;">Declined</button></td>
                                                        @endif
                                                </tr>
                                                @empty
                                                <td>No Data </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                </div>
                                <!-- End Pending -->

                                <!-- Confirmed -->
                                <div class="tab-pane fade" id="pills-confirmed" role="tabpanel" aria-labelledby="pills-confirmed-tab" style="overflow-x:auto;">
                                    <table class="table  table-hover">
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
                                                @forelse($bookingConfirmed as $key =>$booking)
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
                                                    <td>{{date('h:i A', strtotime($booking->time_start))}} - {{date('h:i A', strtotime($booking->time_end))}}</td>
                                                    <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>
                                                <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                                                        @if($booking->book_status==1)
                                                        <td><a href="{{route('visited.status',[$booking->id])}}"><button class="btn btn-success">Visited</button></a></td>
                                                        <td><a href="{{route('notVisited.status',[$booking->id])}}"><button class="btn btn-danger">Not Visited</button></a></td>
                                                        @endif
                                                </tr>
                                                @empty
                                                <td>No Data </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                </div>
                                <!-- End Confirmed -->

                                <!-- Declined -->
                                <div class="tab-pane fade" id="pills-declined" role="tabpanel" aria-labelledby="pills-declined-tab" style="overflow-x:auto;">
                                <table class="table   table-hover">
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
                                                @forelse($bookingDeclined as $key =>$booking)
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
                                                <td>{{date('h:i A', strtotime($booking->time_start))}} - {{date('h:i A', strtotime($booking->time_end))}}</td>
                                                <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>
                                                <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                                                @if($booking->book_status==1)
                                                    <td>
                                                        <a href="{{route('accept.status',[$booking->id])}}"><button class="btn btn-primary">Re-Accept</button></a>
                                                    </td>
                                                @endif
                                                @if($booking->book_status==2)
                                                    <td>
                                                        <button class="btn btn-danger" style ="background-color:#47ceff;">Visited</button>
                                                    </td>
                                                        @endif
                                                @if($booking->book_status==3)
                                                    <td>
                                                        <button class="btn btn-danger" style ="background-color:#eb095c;">Not Visited</button>
                                                    </td>
                                                @endif
                                                @empty
                                                <td>No data</td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                </div>
                                <!-- End Declined -->

                                <!-- Cancelled -->
                                <div class="tab-pane fade" id="pills-cancelled" role="tabpanel" aria-labelledby="pills-cancelled-tab" style="overflow-x:auto;">
                                <table class="table   table-hover">
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
                                                @forelse($bookingCancelled as $key =>$booking)
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
                                                    <td>{{date('h:i A', strtotime($booking->time_start))}} - {{date('h:i A', strtotime($booking->time_end))}}</td>
                                                    <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>
                                                <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                                                <td></td>                                                       
                                                @empty
                                                <td>No data</td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                </div>
                                <!-- End Cancelled -->
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
