@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
           

            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Doctors</h5>
                    <span>Appoinment time</span>
                    
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
        @if(Session::has('errmessage'))
            <div class="alert bg-danger alert-success text-white" role="alert">
                {{Session::get('errmessage')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
                
            </div>  
        @endforeach
    </form>
    <h3>My Time list</h3>
    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Time</th>
                          <th scope="col">Created date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($appointments as $key => $appointment)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$appointment->doctor->user_lName}}</td>
                          <td>{{date('h:i A', strtotime($appointment->time_start))}} - {{date('h:i A', strtotime($appointment->time_end))}}</td>
                          <td>{{date('F j - Y,', strtotime($appointment->app_date))}}</td>
                          <td>       
                          <a href="{{route('appointment.edit',[$appointment->id])}}" class="btn btn-primary">Edit</a>
                          <a href="{{route('appointment.show',[$appointment->id])}}" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @empty
                        <td>You have no any appointments</td>
                        @endforelse
                      </tbody>
    </table>
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