@extends('layouts.master')
@section('content')

<style>
/* #datepicker
{
  display:none;
}
#datepicker_label
{
  display:none;
}
#time_label
{
  display:none;
}
#time_slots
{
  display:none;
}
#btn_submit
{
  display:none;
} */

</style>

<section id="appointment">
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
                    

    <div class ="card ">
            <div class="card-header text-success text-center">
              <h2>Select a doctor</h2>
            </div>
            <div class="row">
            @foreach($doctors as $doctor)  
        <div class="card-body ">        
            <div class="col">
              <div class="card" style="height: 18rem; width: 100%">
              @if(!$doctor->user->user_image)
                <center>
                  <img src="{{asset("/images/mdavatar.png")}}"  style="width: 100px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
                </center>
              @else
                <center>
                <img src="{{asset('images')}}/{{$doctor->user->user_image}}" style="width: 100px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
                </center>
              @endif
                <div class="card-body text-center">
                  <h5 class="card-title" >Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}}</h5>           
                  <input type="hidden" id="doctorName" value="Dr. {{$doctor->user->user_fName}}">
                  <p class="card-text">{{$doctor->doctor_department}}</p>
                  <!-- <label class="btn btn-primary">
                        <input type="radio" name="doctorId" id="doctorId" value="{{$doctor->id}}"> 
                        <span>Choose Doctor</span>
                  </label> -->
                    <a href="{{route('booking.showDoctor',[$doctor->id])}}"><i class="btn btn-primary" style="color:white">Book appointment</i></a>
                    
                    <!-- <a href="#" data-toggle="modal" data-target="#myModal{{$doctor->id}}"> <button type="button" class="btn btn-primary">Select Doctor</button></a>  -->
                  </button>
                </div>
              </div>
            </div>
            @include('bookappModal')               
            @endforeach
        </div>

      </div>
    </div>
<section>

    
 

  

  <style>
  .flex-container{display: flex;justify-content: space-around;background:#fff;}
  div.ui-datepicker{
    width: 100% !important;
    line-height: 1;
    text-align: center;
  }
/* .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
  background: #f6f6f6;
  border: 1px solid #c5c5c5;
  color: #454545;  
} */
  
input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: groove;
        background-color: #FFFFFF;
      }
      
      .no-outline:focus {
        outline: none;
      }

.red a{
  background-color: red !important;
  border-radius: 20px;
}
.yellow a{
  background-color: yellow !important;
  border-radius: 20px;
}
.green a{
  background-color: green !important;
  border-radius: 20px;
}

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

.modal {
 width: 100%;
 height: 100%;

 justify-content: center;
 align-items: center;
}

</style>

     
@endsection
