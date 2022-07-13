@extends('admin.layouts.master')

@section('content')
<div class="container">
    <a href="{{route('patient.index')}}" class="btn btn-primary">Back</a>
    <div class="row">
 
        <div class="col-md-3">
    
            <div class="card">
                
                <div class="card-body">
                    
                    <h4 class="text-center">Patient Information</h4>
                    @if(!$user->user_image)
                    <img src="{{asset('images/user.png')}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @else
                    <img src="{{asset('profiles')}}/{{$user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @endif
                    <br>
                    <p>Name: {{ucfirst($user->user_fName)}} {{ucfirst($user->user_lName)}}</p>
                    <p>Gender: {{ucfirst($user->user_gender)}}</p>
                    <p>Address: {{$user->user_address}}</p>
                    <p>Birthdate: {{$user->user_birthdate}}</p>
                </div>
            </div>
            </div>
            <div class="col-md-9">
                    <div class="card">
                        <div class="card-header"><strong><h2>Medical Records</h2></strong></div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-bordered table-hover table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date of appointment</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Findings</th>
                                            <th scope="col">Prescription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($prescriptions as $prescription)
                                            <tr>
                                            <td>{{date('F j, Y', strtotime($prescription->app_date))}}</td>
                                            <td>Dr. {{$prescription->doctor->user->user_fName}} {{$prescription->doctor->user->user_lName}}</td>
                                            <td>{{$prescription->pres_findings}}</td>
                                            <td><a href="{{route('patient.prescription',[$prescription->user_id,$prescription->app_date])}}"><button class="btn btn-secondary" style="font-size: 12px;">View Prescription</button></a></td>
                                            </tr>
                                            @empty
                                            <td> You have no History</td>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
   
    </div>
</div>
@endsection
