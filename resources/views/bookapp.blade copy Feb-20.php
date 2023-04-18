@extends('layouts.master')
@section('content')

<style>
#datepicker
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
}

</style>
<section id="appointment">
<div class="card">
      <div class="card-body">
        <form>
        <div class="form-row">         
          <div class="form-group col-md-4">
            <label for="doctor_id" id="doctor_label"><h3>Select Doctor</h3></label> 
            <select class="form-control" placeholder="Select Doctor" name="doctor_id" id="doctor_id">
            <option value ="">Select Doctor</option>
            @foreach($doctors as $doctor)    
              <option value="{{$doctor->id}}">{{$doctor->user->user_fName}} {{$doctor->user->user_lName}}</option>
            @endforeach
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="datepicker" id="datepicker_label"><h3>Date</h3></label> 
            <input type="text" class="form-control" placeholder="Date" id="datepicker">
          </div>
          <div class="form-group col-md-5">
            <label for="Time" id="time_label"><h3>Time</h3></label> 
            <select class="form-control" placeholder="Time" name="time" id="time_slots">

            <select>
          </div>
          <div class="form-group col-md-5">
          <span id="result"></span>
          </div>
          <div class="form-group col-auto">
            <br><br>
            <button type="submit" id="btn_submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        </form>
      </div>
    </div>    
    
<section>

    

   
<!-- The Modal -->
<!-- Modal -->

<!-- End modal -->
    <style>
  .flex-container{display: flex;justify-content: space-around;background:#fff;}
  div.ui-datepicker{
 font-size:15px;
 line-height: 1.9;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
  background: #f6f6f6;
  border: 1px solid #c5c5c5;
  color: #454545;  
}
</style>

     
@endsection
<!-- <script>
                $(document).ready(function(){
                    $.ajaxSetup(
                    {
                            headers: 
                            {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    var dates= @json($dates);
                    console.log(dates)
                    $("#datepicker").datepicker({
                            dateFormat: 'yy-mm-dd',
                            numberOfMonths: 2,
                            showButtonPanel: true,
                            altField: "#alternate",
                            minDate: new Date(),
                            beforeShowDay: enableAllTheseDays
                        });  
                        function enableAllTheseDays(date) {
                            var sdate = moment(date).format('YYYY-MM-DD');

                            if ($.inArray(sdate, dates) !== -1) {
                            return [true];
                            }

                            return [false];
                        }
                });
        </script>   -->