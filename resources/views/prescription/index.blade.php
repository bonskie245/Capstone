@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-book bg-blue"></i>
                        <div class="d-inline">
                            <h5>Prescription</h5>
                            <span>Prescription Tab</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('doctor.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Prescription</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>
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
        <div class="col-md-12 col-xl-14">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>
                <div class="card-body">
                   <table id="data_tables" class="table table-hover" style="width:100%">
                   <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Reason</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Date</th>
                          <th scope="col">Time</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                          <th scope="row">{{$booking->id}}</th>
                            @foreach($booking->user as $user)
                            @if(!$user->user_image)
                            <td><img src="{{asset('images/user.png')}}"
                                width="80" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                            @else
                            <td><img src="{{asset('profiles')}}/{{$user->user_image}}"
                                width="80" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                            @endif
                            <td>{{$user->user_lName}} ,  {{$user->user_fName}}</td>
                                @if(!$booking->book_reason)
                              <td>Did not indicate reason</td>
                              @else
                                <td>{{$booking->book_reason}}</td>
                             @endif
                            <td>{{$user->user_phoneNum}}</td>
                            @endforeach
                            <td>{{$booking->app_date}}</td>
                            <td>{{date('h:i A', strtotime($booking->time_start))}} - {{date('h:i A', strtotime($booking->time_end))}}</td>

                          <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td> 
                          <td>

                                <button type="button" class = "btn btn-primary"><a href="{{route('prescription.create',[$booking->id,$booking->app_date,$booking->doctor_id])}}" style="color:white">Write Prescription</a></button>                             
                                <!-- <a href="{{route('prescription.show',[$booking->user_id,$booking->app_date])}}" class="btn btn-secondary">View Prescription</a> -->

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
