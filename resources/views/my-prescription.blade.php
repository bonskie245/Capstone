@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Medical history</h2></div>
                    <div class="card-body" style="overflow-x:auto;">
                            <table id="data_tables" class="table table-hover" style="width: 100%; margin: auto 0;">
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
                                    @foreach($prescriptions as $prescription)
                                    <tr>
                                        <td scope="row">{{date('F j, Y', strtotime($prescription->app_date))}}</td>
                                        @if(!$prescription->doctor->user->user_image)
                                        <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                        @else
                                        <td scope="row"><img src="{{asset('images')}}/{{$prescription->doctor->user->user_image}}" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                        @endif
                                        <td scope="row">Dr. {{$prescription->doctor->user->user_fName}} {{$prescription->doctor->user->user_lName}}</td>
                                        <td scope="row">{{$prescription->pres_findings}}</td>
                                        <td scope="row"><a href="{{route('show.prescription',[$prescription->id])}}"><button class="btn btn-primary" style="font-size: 12px;">View Prescription</button></a></td>
                                    </tr>
                                    @endforeach      
                                </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
