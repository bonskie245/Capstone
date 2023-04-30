@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>Walk-in/Call Patient Appointment</h5>
                            <span>Appointment</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('walkIn.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Doctors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>

        <div class="container">
        <div class="row">
            <div class="col">
            <a href="{{route('patient')}}"><button class="btn btn-primary" >Back</button></a>
            </div>
        </div><br>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor Information</h4>
                    @if(!$doctor->user->user_image)
                    <img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @else
                    <img src="{{asset('images')}}/{{$doctor->user->user_image}}" width="120px" style="border-radius: 100%; display: block; margin: 0 auto;">
                    @endif
                    <br>
                    <p>Name: {{ucfirst($doctor->user->user_fName)}} {{ucfirst($doctor->user->user_lName)}}</p>
                    <p>Gender: {{ucfirst($doctor->user->user_gender)}}</p>
                    <p>Specialize: {{$doctor->user->user_department}}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h3>Recent bookings</h3></div>
                <div class="card-body">
                    <div id="calendars" ></div>
                </div>
            </div>
        </div>
        <div class="col">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach

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

            <form action="{{route('walkIn.store')}}" method="post">@csrf  
            <div class="card">
                <div class="card-header"><strong><h2>Booking appointment</h2></strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="datepicker" id="datepicker_label"><h4>Pick a Date: </h4></label>          
                                <div id="datepicker"></div>                  
                        </div>
                    </div>
                <div class="row">
                        <div class="form-group col">
                            <label for="alternate"> <h3>Date:  </h3> </label>
                            <input type="hidden" name="doctor_id" id="doctor_id" value="{{$doctor->id}}">  
                            <input type="text" id="alternate" name="app_date" size="20" class="no-outline">
                        </div>
                        <div class="form-group col">
                            <label for="time_start"><h3>Select Time: </h3></label>  
                            <input type="text" class="timepicker" id="time_start" name="time_start"  autocomplete ="off" required>      
                            <input type="hidden" name="user_id" value="{{$users->id}}">      
                        </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <h4>How are you feeling right now? (Select as many as possible)</h4>
                        <select id="book_reason" name="book_reason[]" style="width:100%" multiple="multiple"  required>
                            @foreach(App\Models\Symptoms::all() as $symptom)
                                <option value="{{$symptom->name}}">{{$symptom->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br> 
                        <div class="form-group col">
                    <hr style="height:2px;border-width:10%;color:grey;background-color:grey;"> 
                            <h4>If Others, Specify</h4>
                                <textarea id="book_others" name="book_reason[]" style="width: 100%">
                                </textarea>
                            </div>
                                                
                </div>       
            </div>
            <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-primary" style="width:170px;">Book Appointment</button>
                    <a href="{{route('users.create')}}" class="btn btn-secondary">Cancel</a>
            </div>
            </form>
        </div>
    </div>
    </div>
<style>
     .flex-container{display: flex;justify-content: space-around;background:#fff;}
  div.ui-datepicker{
    width: 100% !important;
    line-height: 1;
    text-align: center;
  }
</style>
@endsection