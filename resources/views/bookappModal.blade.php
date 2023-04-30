<div class="modal fade bd-example-modal-xl" id="myModal{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="title"></h5>
            <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('booking.appointment')}}" method="post">@csrf 
        <div class="modal-body">
          <!-- Row -->
          <div class="row">
                <div class="form-group col-md-12">
                      <label for="datepicker" id="datepicker_label"><h4>Pick a Date: </h4></label>
                        <div id="datepicker" ></div>
                        <!-- <label for="alternate" id="date_label"><h4>Date: </h4></label>  -->  
                </div>
                <div class="form-group col">
                  <label for="alternate"> <h3>Date: </h3> </label>
                  <input type="text" id="alternate" name="app_date" size="20%" class="no-outline" > 
                </div>
                <div class="form-group col">
                  <label for="time_start"><h3>Select Time: </h3></label>  
                  <input type="text" class="timepicker" id="time_start" name="time_start"  autocomplete ="off" required>      
                </div>     
            </div>
          <!-- Last checkpoint NIA APRIL 13, 2023  -->
          <hr style="height:2px;border-width:10%;color:grey;background-color:grey;"> 
          <!--End Row  -->
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
          <input type="hidden" name="doctor_id" id="doctor_id" value="{{$doctor->id}}">               
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