@extends('layouts.master')

@section('content')
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
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{$error}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endforeach
  <div class="container">                          
    <div class="row">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header"><h2>My Appointments</h2></div>
                <div class="card-body" style="margin-left: 20px;">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending({{$bookingPending->count()}})</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="confirmed-tab" data-toggle="tab" href="#confirmed" role="tab" aria-controls="confirmed" aria-selected="false">Confirmed({{$bookingConfirmed->count()}})</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="declined-tab" data-toggle="tab" href="#declined" role="tab" aria-controls="declined" aria-selected="false">Declined({{$bookingDeclined->count()}})</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled({{$bookingCancelled->count()}})</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <!--Pending -->
                      <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab" style="overflow-x:auto; margin: 0 auto;" >                
                      <table id="data_tables" class="table table-bordered table-hover" style="width:100%; margin: 0 auto;">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col"  style="font-size: 16px;">Image</th>
                          <th scope="col"  style="font-size: 16px;">Doctor</th>
                          <th scope="col"  style="font-size: 16px;">Time</th>
                          <th scope="col"  style="font-size: 16px;">Date</th>
                          <th scope="col"  style="font-size: 16px;">Status</th> 
                          <th scope="col"  style="font-size: 16px;">Action</th>
                          <!-- <th scope="col"></th> -->
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($bookingPending as $key => $booking)
                        <tr>
                          <td>{{$key+1}}</td>
                          @if(!$booking->doctor->user->user_image)
                          <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                          @else
                          <td><img src="{{asset('images')}}/{{$booking->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                          @endif
                          
                          <td >Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                            <td>{{date('h:i a', strtotime($booking->time_start))}} - {{date('h:i a', strtotime($booking->time_end))}}</td>
                            <td>{{date('F j - Y,', strtotime($booking->app_date))}}</td>
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
                            @if($booking->book_status==0)
                                <a href="{{route('booking.showEditDoctor',[$booking->id])}}">
                                  <i class="btn btn-success" style="color:white;">Reschedule</i>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal{{$booking->id}}"> 
                                  <i class="btn btn-danger" style="color:white">Cancel Booking</i>
                                  </a>     
                                      <!-- <button type="button" id="no" class="btn btn-success">No, Change Time only</button> -->
                              
                                      <!-- <a href="#" data-toggle="modal" data-target="#myModal{{$booking->id}}" id="editBook" style="color:blue"> 
                                            <i class="ik ik-trash-2" style="color:green">Cancel Booking</i>
                                        </a> -->
                            @endif
                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                            <input type="hidden" name="app_id" value="{{$booking->app_id}}">
                            <input type="hidden" id="doctorId" name="doctorId" value="{{$booking->doctor_id}}">       
                        </td>
                        </tr>
                        @include('booking.editModal')
                        @include('booking.deleteModal')
                        @endforeach
                      </tbody>
                    </table>
                    
                      </div>
                      <!-- End of Pending -->

                      <!-- Confirmed -->
                      <div class="tab-pane fade" id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab" style="overflow-x:auto; ">
                      <table id="data_confirmed" class="table table-bordered table-hover" style="width:100%;  margin: 0 auto;">
                      <thead>
                        <tr>
                          <th scope="col"  style="font-size: 16px;">#</th>
                          <th scope="col"  style="font-size: 16px;">Image</th>
                          <th scope="col"  style="font-size: 16px;">Doctor</th>
                          <th scope="col"  style="font-size: 16px;">Time</th>
                          <th scope="col"  style="font-size: 16px;">Date</th>
                          <th scope="col"  style="font-size: 16px;">Status</th> 
                          <th scope="col" style="font-size: 16px;">Action</th>     
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($bookingConfirmed as $key => $booking)
                        <tr>
                        <td>{{$key+1}}</td>
                          @if(!$booking->doctor->user->user_image)
                          <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                          @else
                          <td><img src="{{asset('images')}}/{{$booking->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                          @endif
                          
                          <td >Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                            <td></td>
                            <td></td>
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
                                      <a href="{{route('booking.showDoctor',[$booking->id])}}" style="font-size: 10px;"><i class="fa fa-edit" style="color:green">Edit Booking</i></a>
                            @endif
                            @if($booking->book_status!=2)
                                        <a href="#" data-toggle="modal" data-target="#deleteModal{{$booking->id}}"> 
                                          <i class="btn btn-danger" style="color:white">Cancel Booking</i>
                                        </a>    
                            @endif
                            </div>
                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                            <input type="hidden" name="app_id" value="{{$booking->app_id}}">
                            <input type="hidden" id="doctorId" name="doctorId" value="{{$booking->doctor_id}}">
                        </td>
                        </tr>
                        @include('booking.editModal')
                        @include('booking.deleteModal')
                        @endforeach
                      </tbody>
                    </table>
                      </div>
                      <!-- End of Confirmed -->

                      <!-- Start of Declined -->
                      <div class="tab-pane fade" id="declined" role="tabpanel" aria-labelledby="declined-tab" style="overflow-x:auto;">
                        <table id="data_declined" class="table table-bordered table-hover" style="width:100%;   margin: 0 auto; ">
                            <thead>
                              <tr>
                                <th scope="col"  style="font-size: 16px;">#</th>
                                <th scope="col"  style="font-size: 16px;">Image</th>
                                <th scope="col"  style="font-size: 16px;">Doctor</th>
                                <th scope="col"  style="font-size: 16px;">Time</th>
                                <th scope="col"  style="font-size: 16px;">Date</th>
                                <th scope="col"  style="font-size: 16px;">Status</th> 
                                <th scope="col" style="font-size: 16px;">Action</th>                               
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($bookingDeclined as $key => $booking)
                              <tr>
                              <td>{{$key+1}}</td>
                                @if(!$booking->doctor->user->user_image)
                                <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                @else
                                <td><img src="{{asset('images')}}/{{$booking->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                @endif
                                
                                <td >Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                                  <td>{{$booking->time_start}} - {{$booking->time_end}}</td>
                                  <td>{{$booking->app_date}}</td>
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
                                  <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                  <input type="hidden" name="app_id" value="{{$booking->app_id}}">
                                  <input type="hidden" id="doctorId" name="doctorId" value="{{$booking->doctor_id}}">
                              </td>
                              </tr>
                              @include('booking.editModal')
                              @include('booking.deleteModal')
                              @endforeach
                            </tbody>
                          </table>
                      </div>
                      <!-- End of Declined -->

                      <!-- Start of Cancelled -->
                      <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab" style="overflow-x:auto;" >
                        <table id="data_cancelled" class="table table-bordered table-hover" style="width:100%;   margin: 0 auto;">
                            <thead>
                              <tr>
                                <th scope="col"  style="font-size: 16px;">#</th>
                                <th scope="col"  style="font-size: 16px;">Image</th>
                                <th scope="col"  style="font-size: 16px;">Doctor</th>
                                <th scope="col"  style="font-size: 16px;">Time</th>
                                <th scope="col"  style="font-size: 16px;">Date</th>
                                <th scope="col"  style="font-size: 16px;">Status</th> 
                                
                                <!-- <th scope="col" style="font-size: 16px;">Action</th>                -->
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($bookingCancelled as $key => $booking)
                              <tr>
                              <td>{{$key+1}}</td>
                                @if(!$booking->doctor->user->user_image)
                                <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                @else
                                <td><img src="{{asset('images')}}/{{$booking->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                @endif
                                
                                <td >Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
                                  <td></td>
                                  <td></td>
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
                                      @if($booking->book_status==5)
                                        <span class="badge badge-pill badge-danger mb-1">Appointment Cancelled</span>
                                      @endif
                                </td>

                                <!-- <td>
                                <div class="table-actions">
                                  @if($booking->book_status==5)
                                           <i class="fa fa-edit" style="color:green">Cancelled</i>
                                  @endif
                                  </div>                          
                              </td> -->
                              <input type="hidden" name="booking_id" value="{{$booking->id}}">
                              <input type="hidden" name="app_id" value="{{$booking->app_id}}">
                              <input type="hidden" id="doctorId" name="doctorId" value="{{$booking->doctor_id}}">
                              </tr>
                              @include('booking.editModal')
                              @include('booking.deleteModal')
                              @endforeach
                            </tbody>
                          </table>                  
                      </div>
                      <!-- End of Cancelled -->       
                </div>
    </div>

 <!-- Last Checkpoint March 29, 2023 -->
    <!-- Modal Only -->


    <!-- End Modal -->
@endsection
