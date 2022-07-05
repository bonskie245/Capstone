@extends('admin.layouts.master')

@section('content')
<div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-clock bg-blue"></i>
                   <div class="d-inline">
                       <h5>Walk-In / Call Appointment</h5>
                       <span>Appointment</span>
                   </div>
               </div>
           </div>
           
           <div class="col-lg-4">
               <nav class="breadcrumb-container" aria-label="breadcrumb">            
               		<ol class="breadcrumb">        
               			<li class="breadcrumb-item">           
               				<a href="#">
               				<i class="ik ik-home"></i></a>
                        </li>
                       <li class="breadcrumb-item"><a href="#">Appointment</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Make Appointment
            		   </li>
                  </ol>
               </nav>
          </div>
       </div>
  </div>
    
  <div class="row justify-content-center" style="margin:auto;">
        <div class ="card">
            <div class ="card-header"> <h3> <strong>Make Appointment for {{$users->user_fName}} {{$users->user_lName}} </strong> </h3></div>
        
        </div>
            <!-- Search Doctor -->
                <div class="card">
                    <div class="card-body">
                        <div class="card-header"><h2>Find Doctors by Date</h2></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                <form action="{{route('walkIn.appointment', [$users->id])}}" method="GET">
                                <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="app_date">
                              
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit">Search</button>
                               
                                </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
           
  
        <!-- Card -->
        <!-- Display Doctors -->
            <div class="card">
                
                <div class="card-body">
                
                    <div class="card-header"> <h2>List of Doctors on <strong>{{date('F j, Y', strtotime($date))}}</strong></h2></div>
                    <div class="card-body">
                        <table id = "data_table" class="table table-bordered table-light">
                            <thead class ="thead-light">
                                <tr>
                                <th scope="col">Doctor Picture</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Specialize</th>
                                <th scope="col">Action</th>
                                <th class="nosort">&nbsp;</th>

                                </tr>
                            </thead>
                            <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                @if(!$doctor->doctor->user->user_image)
                                    <td><img src="{{asset("/images/user.png")}}" width="90px" style="border-radius: 80px;"></td>
                                @else
                                <td>
                                    <img src="{{asset('images')}}/{{$doctor->doctor->user->user_image}}"
                                    width="90px" style="border-radius: 80px;">
                                </td>
                                @endif
                                <td>Dr. {{$doctor->doctor->user->user_fName}} {{$doctor->doctor->user->user_lName}}</td>
                                <td>{{$doctor->doctor->user->user_department}}</td>
                                <td>
                                    <a href="{{route('WalkIn.createApp',[$doctor->doctor_id,$doctor->app_date,$users->id])}}"><button class="btn btn-primary">Book an appointment</button></a>
                                </td>
                                @empty
                                <tr>
                                <td> <strong style="font-size: 20px;">No Doctors Available for today / Or this paritcular date</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>

                                @endforelse 
                            </tbody>
                        </table>
                </div>
             </div>
            </div>
            <!-- end Card -->

  </div>
@endsection