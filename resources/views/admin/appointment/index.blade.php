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
                <div class="card">
                    <div class="card-header"><h2> Your Appointment time list: {{$myappointment->count()}}</h2></div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">View/Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myappointment as $appointment)
                                <tr>
                                <th scope="row">{{$appointment->id}}</th>
                                <td>Dr. {{$appointment->doctor->user->user_fName}} {{$appointment->doctor->user->user_lName}}</td>
                                <td>{{date('F j - Y,', strtotime($appointment->app_date))}}</td>
                                <td>
                                    <form action="{{route('appointment.showTime',[$appointment->doctor->id,$appointment->app_date])}}" method="get">
                                    <button type="submit" class="btn btn-primary">View/Update</button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
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