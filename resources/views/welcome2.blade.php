@extends('layouts.app')

@section('content')
<div class="container">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @guest
        <h1 style="text-align:center; margin-bottom: 60px; font-weight: bold;">Welcome to Urgent Care Clinic</h1>
    
        <div class="row">
      
        <div class="col-md-6">
            <img src="{{asset('banner/Medicine-banner.jpg')}}" class="img-fluid" style="border: 1px solid #ccc;">
        </div>
        <div class="col-md-6">
            <h2>Create an account & Book your appointment</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
       
            <div class="mt-5">
                <a href="{{ route('register') }}"><button class="btn btn-success">Register</button></a>
                <a href="{{ route('login') }}"><button class="btn btn-secondary">Login</button></a>
            </div>
           
        </div>
    </div>
    <hr>
    @endguest
  
    @auth
    <h1 style="text-align:center; margin-bottom: 60px; font-weight: bold;">Welcome to Urgent Care Clinic</h1>
    <h3 style="text-align:center; margin-bottom: 60px; font-weight: bold;">Make Your Appointment Below</h3>
    @endauth
<!-- Search Doctor -->
<form action="{{url('/')}}" method="GET">
    <div class="card">
        <div class="card-body">
            <div class="card-header"><h2>Find Doctors by Date</h2></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                            <input type="text" autocomplete="off" name="app_date" class="form-control" id="datepicker">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Search</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <!-- Display Doctors -->
    <div class="card">
        <div class="card-body">
            
            <div class="card-header"> <h2>List of Doctors on <strong>{{date('F j, Y', strtotime($date))}}</strong></h2></div>
            <div class="card-body">
                <table class="table table-bordered table-light">
                      <thead class ="thead-light">
                        <tr>
                          <th scope="col">Doctor Picture</th>
                          <th scope="col">Doctor Name</th>
                          <th scope="col">Specialize</th>
                          <th scope="col">Booking</th>
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
<hr>
<br>
<br>
<br>
@endsection
