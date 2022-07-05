@extends('layouts.app')

@section('content')

@guest
     <!--? slider Area Start-->
     <div class="slider-area position-relative">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center"  style="height: 560px;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                            <div class="hero__caption">
                                <span>Welcome to Urgent Care Clinic Appointment System</span>
                                <h1 class="cd-headline letters scale">Make your appointments below

                                </h1>
                                <a href="{{route('login')}}" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.5s">Login now</a>
                                <a href="{{route('register')}}" class="btn hero-btn" data-animation="fadeInRight" data-delay="0.5s">Sign-Up now</a>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
    <!-- slider Area End-->
<br>
<br>
<br>
<br>
@endguest
@auth
    <div class="header" style="Background:#2974F3; margin: auto;">
    <br>
    <h1 style="text-align:center; color: #FFFFFF; margin-bottom: 20px; font-weight: bold; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Welcome to Urgent Care Clinic</h1>
    <h3 style="text-align:center; color: #FFFFFF;  font-weight: bold; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Make Your Appointment Below</h3>
    <br>
    </div>
    <br>
@endauth
     <!-- MAKE AN APPOINTMENT -->
<section id="appointment">
          <div class="container">
                         <!-- Search Doctor -->
                    <form action="{{url('/')}}" method="GET">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-header"><h2>Find Doctors by Date</h2></div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-md-8">
                                             <input type="text" autocomplete="off"  name="app_date" class="form-control" id="datepicker">
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
