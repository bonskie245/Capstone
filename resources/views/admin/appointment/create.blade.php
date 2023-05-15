@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
           
            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Doctors</h5>
                    <span>Vacation / Leave Dates</span>
                    
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
                          <script>
                            Swal.fire({
                              title: 'Success',
                              text: '{{Session::get('message')}}',
                              icon: 'success',
                              confirmButtonText: 'Okay  '
                            })
                          </script>
                    @endif
                    @if(Session::has('errmessage'))
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{Session::get('errmessage')}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endif
                    @foreach($errors->all() as $error)
                        <!-- <div class="alert alert-danger">
                            {{$error}}                        
                        </div>   -->
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{$error}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endforeach
    
        
    <form autocomplete="off" action="{{route('appointment.store')}}" method="post">@csrf
    <div class="col d-flex justify-content-center">
    <div class="card" style="width: 75%; ">
        <div class="card-header">
            Choose date
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col ">
                <label for="app_date">Choose Date From: </label>
                <input type="text" class="form-control datetimepicker-input"  style="width: 200px;" autocomplete="off" id="datepickers3" data-toggle="datetimepicker" data-target="#datepickers3" name="app_date">  
                <span id="dateError" class="text-danger"></span>
                <br>
            </div>
            <div class="col">
                <label for="app_date">Choose Date To: </label>
                <input type="text" class="form-control datetimepicker-input" style="width: 200px;" autocomplete="off" id="datepickers2" data-toggle="datetimepicker" data-target="#datepickers2" name="app_date2">  
                <span id="dateError" class="text-danger"></span>
            </div>
        </div>
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
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

         


<br>
<br>
<br>
<br>
<br>
<br>
@endsection