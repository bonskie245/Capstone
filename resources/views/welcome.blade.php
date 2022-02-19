@extends('layouts.app')

@section('content')
<div class="container">
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

<!-- Search Doctor -->
<form action="{{url('/')}}" method="GET">
    <div class="card">
        <div class="card-body">
            <div class="card-header"><h3>Find doctors</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                            <input type="text" autocomplete="off" name="date" class="form-control" id="datepicker">
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
            <div class="card-header"> <h2>Doctor list</h2></div>
            <div class="card-body">
                <table class="table table-striped table-light">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Avatar</th>
                          <th scope="col">Firstname</th>
                          <th scope="col">Lastname</th>
                          <th scope="col">Specialize</th>
                          <th scope="col">Book</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($doctors as $doctor)
                        <tr>
                          <th scope="row">1</th>
                          <td>
                              <img src="{{asset('images')}}/{{$doctor->doctor->image}}"
                              width="90px" style="border-radius: 100px;">
                          </td>
                          <td>{{$doctor->doctor->fName}}</td>
                          <td>{{$doctor->doctor->lName}}</td>
                          <td>{{$doctor->doctor->department}}</td>
                          <td>
                              <a href="{{route('create.appointment',[$doctor->user_id,$doctor->date])}}"><button class="btn btn-primary">Book an appointment</button></a>
                          </td>
                        @empty
                            <td>No Doctors Available for today</td>
                        @endforelse 
                        </tr>
                      </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
