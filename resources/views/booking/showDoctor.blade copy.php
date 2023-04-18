@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Search Doctor -->
        
            <div class="card" id="option" style="width: 30rem; align-items: center; margin: auto;">
                <div class="card-header">
                    <h3>Edit appointment</h3>
                </div>
                    <div class="card-body">
                                <h3>Change Doctor? </h3> <br>                          
                        <div class="row">
                            <div class="col">
                            <button type="button" id="yes" class="btn btn-primary">Yes</button>
                            <button type="button" id="no" class="btn btn-danger">No, Change Time only</button>

                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                            <input type="hidden" name="app_id" value="{{$appID}}">
                            <input type="hidden" name="doctorId" value="{{$doctorID}}">
                            <input type="hidden" name="doctorName" value="Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}">
                           
                            </div>
                        </div>               
                    </div>
                </div>
            </div> 

           
            <div class="card" id="doctor" style="display:none;">
           
            <div class="row">
            @foreach($doctors as $doctor)  
            <div class="col-sm-6">
              <div class="card" style="height: 18rem;">
                @if(!$doctor->user->user_image)
                    <center>
                    <img src="{{asset("/images/mdavatar.png")}}"  style="width: 100px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
                    </center>
                @else
                    <center>
                    <img src="{{asset('images')}}/{{$doctor->user->user_image}}" style="width: 100px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
                    </center>
                @endif
                    <div class="card-body">
                    <h5 class="card-title" >Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}}</h5>           
                    <input type="hidden" id="doctorName" value="Dr. {{$doctor->user->user_fName}}">
                    <p class="card-text">{{$doctor->doctor_department}}</p>
                    <label class="btn btn-primary">
                            <input type="radio" name="doctorId" id="doctorId" value="{{$doctor->id}}"> 
                            <span>Choose Doctor</span>
                    </label>
                    <!-- <button type="button" class="btn btn-primary" id="myDoctorId">Select Doctor</button> -->
                    <!-- <button type="button" id="myDoctorId" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> -->
                    </button>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>

    <!-- Last Checkpoint March 29, 2023 -->
    <!-- Modal Only -->
    <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <form action="{{route('booking.updateTime',[$booking->id])}}" method="post">@csrf 
                @method('PUT')
                    <div class="modal-body">
                    <!-- Row -->
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label for="datepicker" id="datepicker_label"><h4>Pick a Date: </h4></label>                               
                                    <div id="datepicker" ></div>
                                    <!-- <label for="alternate" id="date_label"><h4>Date: </h4></label>  -->  
                            </div>
                            <div class="form-group col-md-5">
                                <label for="alternate"> <h3>Available Time for: </h3> </label>
                                <input type="text" id="alternate" name="app_date" size="20" class="no-outline">
                                <input type="hidden" name="appID" value="{{$appID}}">
                                <input type="hidden" name="doctorId" value="{{$doctorID}}">
                                <div class="row" id="result">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <!-- End Modal -->
@endsection