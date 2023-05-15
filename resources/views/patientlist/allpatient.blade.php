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
                    <i class="ik ik-bar-chart bg-blue"></i>
                    <div class="d-inline">
                        <h5>Charge Report</h5>
                        <span>Charge Report</span>
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
                <div class="card-header" style="font-size: 20px;"><strong>Appointments</div></strong>
                <form action="{{route('all.appointments')}}" method="GET">
                    @csrf
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
                                <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepickers2" data-toggle="datetimepicker" data-target="#datepickers2" name="date_from">
                            </div>
                            <label for="date_to"> Date To: </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control datetimepicker-input" autocomplete="off" id="datepickers3" data-toggle="datetimepicker" data-target="#datepickers3" name="date_to">
                            </div>    
                           
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                                <!-- <a href="{{route('generatePDF')}}"><span class="btn btn-secondary">Print</span></a>     -->
                            </div>    
                            <div class="col-md-1">
                            <form action="{{route('generatePDF')}}" method="GET">
                                    @if(isset($from))
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                    @endif
                                <button type="submit" class="btn btn-secondary">Print</button>
                            </from>
                            </div>      
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
                          <th scope="col">Charge</th>
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
                                <td>₱  {{number_format($booking->charge,2) }}</td>
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
