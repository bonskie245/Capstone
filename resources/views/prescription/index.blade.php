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
    <div class="card">
        <div class="card-header">
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Patient Today ({{$bookings->count()}})</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Prescribed Patients Today @if(isset($prescriptions)) ({{$prescriptions->count()}}) @else (0) @endif</button>
            </div>
            </nav>
            </div>
            <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @if(isset($prescriptions))
                    <table id="data_tables" class="table table-hover" style="width: 100%; margin: auto 0;">
                                <thead>
                                    <tr>
                                        <th scope="col">Date of Appointment</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Doctor Name</th>
                                        <th scope="col">Findings</th>
                                        <th scope="col">View Prescription</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prescriptions as $prescription)
                                    <tr>
                                        <td scope="row">{{date('F j, Y', strtotime($prescription->app_date))}}</td>
                                        @if(!$prescription->doctor->user->user_image)
                                        <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                        @else
                                        <td scope="row"><img src="{{asset('images')}}/{{$prescription->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                        @endif
                                        <td scope="row">Dr. {{$prescription->doctor->user->user_fName}} {{$prescription->doctor->user->user_lName}}</td>
                                        <td scope="row">{{$prescription->pres_findings}}</td>
                                        <td scope="row"><a href="{{route('prescription.show',[$prescription->id,$prescription->app_date])}}"><button class="btn btn-primary" style="font-size: 12px;">View Prescription</button></a></td>
                                    </tr>
                                    @endforeach      
                                </tbody>
                            </table>
                @else
                <table id="data_table" class="table table-hover" style="width:100%">
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
                        <td>No Data</td>
                      </tbody>
                    </table>
                @endif
            </div>
            </div>   
        </div>                     
    </div>
</div>
@endsection
