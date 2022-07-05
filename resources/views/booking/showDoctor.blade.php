@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            @foreach($booking->user as $book)
            <div class="card-header"><h3>Edit appointment for {{$book->user_fName}} {{$book->user_lName}}</h3></div>
            @endforeach
        </div>
        <!-- Search Doctor -->
        <form action="{{route('booking.showDoctor',[$booking->id])}}" method="GET">
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
        <!-- end search doctor -->
        <!-- display doctors -->
        <div class="row">
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
                              <a href="{{route('booking.editTime',[$doctor->doctor_id,$booking->id,$doctor->app_date])}}"><button class="btn btn-primary">Book an appointment</button></a>
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
                <!-- end display doctors -->
        </div>
    </div>
        </div>
    </div>
@endsection