@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              @if(Session::has('message'))
              <div class="alert alert-success"> 
                {{Session::get('message')}}
              </div>
              @endif
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>
                
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Date</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Time</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key=>$booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="{{asset('profiles')}}/{{$booking->user->user_image}}"
                              width="80" style="border-radius: 50%;"></td>
                          <td>{{$booking->app_date}}</td>
                          <td>{{$booking->user->user_lName}} ,  {{$booking->user->user_fName}}</td>
                          <td>{{$booking->user->user_email}}</td>
                          <td>{{$booking->user->user_phoneNum}}</td>
                          <td>{{$booking->time_start}}</td>
                          <td>Dr.{{$booking->doctor->user_lName}}, {{$booking->doctor->user_fName}}</td>
                          
                          <td>@if($booking->status===1)
                                Visited
                              @endif
                          </td>   
                          <td>
                              @if(!App\Models\Prescription::where('date',date('Y-m-d'))->where('doctor_id',auth()->user()->id)->where('user_id',$booking->user->id)->exists())
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$booking->user_id}}">
                                  Write Prescription
                                </button>
                                @include('prescription.form')

                                @else
                               <a href="{{route('prescription.show',[$booking->user_id,$booking->date])}}" class="btn btn-secondary">View Prescription</a>
                                @endif
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
