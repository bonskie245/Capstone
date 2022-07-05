@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
           

            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Doctors</h5>
                    <span>appoinment time</span>
                    
                </div>
            </div>
        </div>
    <div class="col-lg-4">
        <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.html"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                <li class="breadcrumb-item active" aria-current="page">Appointment</li>
            </ol>
        </nav>
    </div>
    </div>
</div>

<div class="container">
         @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
                
            </div>           
        @endforeach
    
   
        @foreach($appointments as $appointment)
             
    <form action="{{route('appointment.update',[$appointment->id])}}" method="post">@csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            Edit Time For {{$appointment->app_date}}
        </div>
    <div class="card">
        <div class="card-header">
            <i class="bi-sunrise" style="font-size: 20px;"></i><span style="margin-left: 5px">Pick time</span>
       
        <div class="card-body">
            <label for="time_start">Select start time:</label>
            <input type="text" class ="timepicker" id="time_start" name="time_start" value="{{$appointment->time_start}}">
        </div>

        <div class="card-body">
            <label for="time_end">Select end time:</label>
            <input type="text" class ="timepicker" id="time_end" name="time_end" value="{{$appointment->time_end}}">
        </div>
        
        
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @endforeach
    </div>
    </form>

</div>

<style type="text/css">
    input[type="checkbox"]{
        zoom:1.1;
   
    }
    body{
        font-size: 18px;
    }
</style>



@endsection