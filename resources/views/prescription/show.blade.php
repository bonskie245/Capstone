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
                <div class="card-header" style="font-size: 20px;">Prescription For {{$prescription->user->lName}}</div>

                <div class="card-body">
                    <p>Date: {{$prescription->date}}</p>
                    <strong><p></strong> Patient: {{$prescription->user->fName}} {{$prescription->user->lName}}</p>
                    <p>Doctor: Dr. {{$prescription->doctor->fName}} {{$prescription->doctor->lName}}</p>
                    <p>Medicine Name: {{$prescription->medicine_name}}</p>
                    <p>Gram: {{$prescription->medicine_gram}}</p>
                    <p>Intake: {{$prescription->medicine_intake}}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
