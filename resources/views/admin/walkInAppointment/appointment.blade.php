@extends('admin.layouts.master')

@section('content')
<div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-clock bg-blue"></i>
                   <div class="d-inline">
                       <h5>Walk-In / Call Appointment</h5>
                       <span>Appointment</span>
                   </div>
               </div>
           </div>
           
           <div class="col-lg-4">
               <nav class="breadcrumb-container" aria-label="breadcrumb">            
               		<ol class="breadcrumb">        
               			<li class="breadcrumb-item">           
               				<a href="#">
               				<i class="ik ik-home"></i></a>
                        </li>
                       <li class="breadcrumb-item"><a href="#">Appointment</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Make Appointment
            		   </li>
                  </ol>
               </nav>
          </div>
       </div>
  </div>
    
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
                    <a href="{{route('WalkIn.createApp',[$doctor->id, $users->id])}}"><i class="btn btn-primary" style="color:white">Book appointment</i></a>
                    
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

    
<div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="title"></h5>
          <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <form action="{{route('walkIn.store')}}" method="post">@csrf 
      <div class="modal-body">
        <!-- Row -->
        <div class="row">
              <div class="form-group col-md-5">
                    <label for="datepicker" id="datepicker_label"><h4>Pick a Date: </h4></label>
                      <div id="datepicker" ></div>
                      <!-- <label for="alternate" id="date_label"><h4>Date: </h4></label>  -->  
              </div>
              <div class="form-group col-md-6">
                  <label for="alternate"> <h3>Available Time for: </h3> </label>
                    <input type="text" id="alternate" name="app_date" size="10%" class="no-outline">
                    <div class="row" id="result">
                    </div>
                    <input type="hidden" name="doctorId" value="{{$doctor->id}}">
                    <input type="hidden" name="user_id" id="userId" value="{{$users->id}}">
              </div>
          </div>
                           <!-- Last checkpoint NIA APRIL 13, 2023  -->
        <hr style="height:2px;border-width:0;color:gray;background-color:gray"> 
        <!--End Row  -->
        <div class="row">
          <div class="form-group col-md-4">
            <h4>How are you feeling right now? (Check as many as possible below)</h4>
            <div class="multiselect">
              <div class="selectBox" style="width: 100%;"onclick="showCheckboxes()">
                <select>
                  <option>Select an option</option>
                </select>
                <div class="overSelect"></div>
              </div>
              <div id="checkboxes" style="width: 100%">
                <label for="1"><input type="checkbox" id="1" class="btn-check" name="book_reason[]" value ="Cough"/>&nbsp;Cough</label>
                <label for="2"><input type="checkbox" id="2" class="btn-check" name="book_reason[]" value ="Nausea"/>&nbsp;Nausea</label>
                <label for="3"><input type="checkbox" id="3"  class="btn-check" name="book_reason[]" value ="Diarrhea"/>&nbsp;Diarrhea</label>
                <label for="4"><input type="checkbox" id="4" class="btn-check" name="book_reason[]" value ="Stomach Ache"/>&nbsp;Stomach Ache</label>
                <label for="5"><input type="checkbox" id="5" class="btn-check" name="book_reason[]" value ="Fever"/>&nbsp;Fever</label>
                <label for="6"><input type="checkbox" id="6" class="btn-check" name="book_reason[]" value ="Head Ache"/>&nbsp;Head Ache</label>
                <label for="7"><input type="checkbox" id="7" class="btn-check" name="book_reason[]" value ="Weight Loss"/>&nbsp;Weight Loss</label>
                <label for="8"><input type="checkbox" id="8" class="btn-check" name="book_reason[]" value ="Sore throa"/>&nbsp;Sore throat</label>
                <label for="9"><input type="checkbox" id="9" class="btn-check" name="book_reason[]" value ="Open Wound / Minor Surgery"/>&nbsp;Open Wound / Minor Surgery</label>
              </div>
            </div>
          </div>
          <div class="form-group col">
                <div id="ifYess">
              <h4>If Others, Specify</h4>
                    <textarea id="book_others" name="book_reason[]" style="width: 80%">
                    </textarea>
                </div>
              </div>                        
        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div> 
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


</style>@endsection