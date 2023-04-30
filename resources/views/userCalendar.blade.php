@extends('layouts.master')

@section('content')
@if(Session::has('message'))
                        <script>
                            Swal.fire({
                              title: 'Success',
                              text: '{{Session::get('message')}}',
                              icon: 'Success',
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
<div class="card">
    <div class="card-header"><h2>Booking Calendar</h2></div>
        <div class="card-body">
            <div class='box grey'> = Pending</div>
            <div class='box green'> = Accepted</div>
            <div class='box blue'> = Visited</div>
            <div class='box pink'> = Not Visited</div>
            <div class='box red'> = Declined</div>
            <div class='box rose'> = Cancelled / Can Book This time frame</div>
            <div class='box darkblue'> = Finished Appointment</div>
            <br><br>
            <a href="{{route('users.create')}}" class="btn btn-primary">Book Appointment</a>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
</div>
<style>
    .box {
    position: relative;
    margin-left: 20px;
    }
    .box:before{
    position: absolute;
    left: -20px;
    content: "";
    height:20px;
    width:20px;
    margin-bottom:15px;
    border:1px solid black;
    }
    .box.red:before{
    background-color:#b51307;
    }
    .box.blue:before{
    background-color:#47ceff;
    }
    .box.grey:before{
    background-color:#727573;
    }
    .box.pink:before{
    background-color:#eb095c;
    }
    .box.green:before{
    background-color:#12f50a;
    }
    .box.rose:before{
        background-color:#DD3E3E;
    }
    .box.darkblue:before{
        background-color: #0000FF;
    }
</style>
@endsection