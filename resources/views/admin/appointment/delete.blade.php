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
    <h3>Delete Time</h3>
    <div class="row justify-content-center">
  		<div class="col-lg-3">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
  			<div class="card-header" align="center">
  				<h3>Delete</h3>
  			</div>
  			<div class="card-body" align="center">
                <p></p>
                <h4>Are you sure to delete Time</h4>
                <h5><strong>{{date('h:i A', strtotime($appointment->time_start))}} - {{date('h:i A', strtotime($appointment->time_end))}}</strong></h5>
  				<form class="forms-sample" action="{{route('appointment.destroy',[$appointment->id])}}" method="POST">@csrf
                    @method('DELETE')

                        <div class="card-footer">
  					 		<button type="submit" class="btn btn-danger mr-2">Confirm</button>
	                        <a href="{{route('appointment.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
				</div>
  			</form>

  			</div>
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