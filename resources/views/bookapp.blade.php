@extends('layouts.master')
@section('content')
<section id="appointment">
          <div class="container">
                         <!-- Search Doctor -->
                    <form action="{{route('users.create')}}" method="GET">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-header"><h2>Find Doctors by Date</h2></div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-md-8">
                                        <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="app_date">
                                        </div>
                                        <div class="col-md-4">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </form>
<section>
    <!-- Display Doctors -->

    <div class="card">
        <div class="card-body">
            <div class="card-header"> <h2>List of Doctors on <strong>{{date('F j, Y', strtotime($date))}}</strong></h2></div>
            <div class="card-body">
                <table class="table table-bordered table-light">
                      <thead class ="thead-light">
                        <tr>
                          <th scope="col" style="font-size: 20px;">Doctor Picture</th>
                          <th scope="col" style="font-size: 20px;">Doctor Name</th>
                          <th scope="col" style="font-size: 20px;">Specialize</th>
                          <th scope="col" style="font-size: 20px;">Booking</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse($doctors as $doctor)
                        <tr>
                          @if(!$doctor->doctor->user->user_image)
                            <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 80px;"></td>
                        @else
                          <td>
                              <img src="{{asset('images')}}/{{$doctor->doctor->user->user_image}}"
                              width="90px" style="border-radius: 80px;">
                          </td>
                          @endif
                          <td style="font-size: 20px;">Dr. {{$doctor->doctor->user->user_fName}} {{$doctor->doctor->user->user_lName}}, {{$doctor->doctor->doctor_title}}</td>
                          <td style="font-size: 20px;">{{$doctor->doctor->doctor_department}}</td>
                          <td>
                              <a href="{{route('create.appointment',[$doctor->doctor_id,$doctor->app_date])}}"><button class="btn btn-primary">Book an appointment</button></a>
                          </td>
                        @empty
                        <tr>
                           <td> <strong style="font-size: 20px;">No Doctors Available for today / Or this paritcular date</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        @endforelse 
                        </tr>
                      </tbody>
                </table>
          </div>
        </div>
    </div>


@endsection
