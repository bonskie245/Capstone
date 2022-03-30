@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Medical history</div>
                    <div class="card-body">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Findings</th>
                                <th scope="col">Medicine name</th>
                                <th scope="col">Medicine Gram</th>
                                <th scope="col">Intake</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prescriptions as $prescription)
                                <tr>
                                <td>{{$prescription->app_date}}</td>
                                <td>Dr. {{$prescription->doctor->user_fName}} {{$prescription->doctor->user_lName}}</td>
                                <td>{{$prescription->medicine_name}}</td>
                                <td>{{$prescription->medicine_gram}}</td>
                                <td>{{$prescription->medicine_intake}}</td>
                                </tr>
                                @empty
                                <td> You have no Prescription </td>
                                @endforelse
                            </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection
