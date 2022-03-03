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
                          <td><img src="{{asset('profile')}}/{{$booking->user->image}}"
                              width="80" style="border-radius: 50%;"></td>
                          <td>{{$booking->date}}</td>
                          <td>{{$booking->user->lName}} ,  {{$booking->user->fName}}</td>
                          <td>{{$booking->user->email}}</td>
                          <td>{{$booking->user->phoneNum}}</td>
                          <td>{{$booking->time}}</td>
                          <td>Dr.{{$booking->doctor->lName}}, {{$booking->doctor->fName}}</td>
                          
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
                                View
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
