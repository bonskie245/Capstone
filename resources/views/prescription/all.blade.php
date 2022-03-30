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
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$patients->count()}})</div></strong>
                
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
                        @forelse($patients as $key=>$patient)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="{{asset('profile')}}/{{$patient->user->image}}"
                              width="80" style="border-radius: 50%;"></td>
                          <td>{{$patient->app_date}}</td>
                          <td>{{$patient->user->user_lName}} ,  {{$patient->user->user_fName}}</td>
                          <td>{{$patient->user->user_email}}</td>
                          <td>{{$patient->user->user_phoneNum}}</td>
                          <td>{{$patient->time}}</td>
                          <td>Dr.{{$patient->doctor->user_lName}}, {{$patient->doctor->user_fName}}</td>
                          
                          <td>@if($patient->status===1)
                                Visited
                              @endif
                          </td>   
                          <td>
                       
                             
                               <a href="{{route('prescription.show',[$patient->user_id,$patient->app_date])}}" class="btn btn-secondary">View Prescription</a>
                     
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
