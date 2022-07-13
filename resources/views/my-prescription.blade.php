@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Medical history</h2></div>
                    <div class="card-body">
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Date of Appointment</th>
                                <th scope="col">Image</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Findings</th>
                                <th scope="col">View Prescription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prescriptions as $prescription)
                                <tr>
                                <td>{{date('F j, Y', strtotime($prescription->app_date))}}</td>
                                <td><img src="{{asset('images')}}/{{$prescription->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                <td>Dr. {{$prescription->doctor->user->user_fName}} {{$prescription->doctor->user->user_lName}}</td>
                                <td>{{$prescription->pres_findings}}</td>
                                <td><a href="{{route('show.prescription',[$prescription->id])}}"><button class="btn btn-primary" style="font-size: 12px;">View Prescription</button></a></td>
                                </tr>
                                @empty
                                <td> You have no History </td>
                                @endforelse
                            </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection
