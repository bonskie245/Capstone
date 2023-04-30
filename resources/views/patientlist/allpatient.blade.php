@extends('admin.layouts.master')

@section('content')
<style>/* style sheet for "A4" printing */
@media print and (width: 21cm) and (height: 29.7cm) {
     @page {
        margin: 3cm;
     }
}

</style>
<div class="container">
<div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
            

                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Appointment</h5>
                        <span>Appointment History</span>
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>
                <form action="{{route('all.appointments')}}" method="GET">
                @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            @if(Session::has('errmessage'))
                                <div class="alert alert-danger">
                                 {{Session::get('errmessage')}}
                                </div>
                @endif
                
              <div class="card-header">
            
                        <div class="row">
                        &nbsp;  &nbsp;  Filter By date From: 
                            <div class="col-md-2">
                                <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker2" data-toggle="datetimepicker" data-target="#datepicker2" name="date_from">
                            </div>
                            <label for="date_to"> Date To: </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepicker3" data-toggle="datetimepicker" data-target="#datepicker3" name="date_to">
                            </div>
                                 
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button class="btn btn-success" onclick="exportTableToPDF()">Print table</button>
                                <!-- <input type="button" class= "btn btn-success" value="Print"  id="btPrint" onclick="exportTableToPDF()" /> -->

                            </div>        
                    </form>
                            
                    </div>             
                </div>
                <div class="card-body" >
                   <table id="data_tables" class="table table-hover" style="width: 100%; margin:auto;" >
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Findings</th>
                          <th scope="col">Date</th>
                          <th scope="col">Doctor</th>
                        </tr>
                      </thead>
                        <tbody>
                        @foreach($bookings as $key => $booking)
                            <tr>
                                <td>{{$key+1}}</td>
                             
                                @if(!$booking->user->user_image)
                                    <td><img src="{{asset('images/user.png')}}"
                                    width="80px "  height="80px" style="border-radius: 50%;"></td>
                                @else
                                    <td><img src="{{asset('profiles')}}/{{$booking->user->user_image}}"
                                    width="80px "  height="80px" style="border-radius: 50%;"></td>    
                                    @endif                      
                                <td>{{$booking->user->user_fName}} {{$booking->user->user_lName}}</td>
                                <td>{{$booking->pres_findings}}</td>
                                <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>

                                <td>Dr.{{$booking->doctor->user->user_lName}}, {{$booking->doctor->user->user_fName}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<tbody>
                        
@endsection
