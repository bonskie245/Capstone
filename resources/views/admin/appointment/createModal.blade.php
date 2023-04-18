<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <h3 id="error" class = "text-danger"></h3>
            <form action="{{route('appointment.store')}}" method="post">@csrf 
                
                    <div class="row">
                        <div class="col">
                            <label for="app_date">Choose Date From: </label>
                            <input type="text" class="form-control datetimepicker-input"  style="width: 200px;" autocomplete="off" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="app_date">  
                            <span id="dateError" class="text-danger"></span>
                            <br>
                        </div>
                        <div class="col">
                            <label for="app_date">Choose Date To: </label>
                            <input type="text" class="form-control datetimepicker-input" style="width: 200px;" autocomplete="off" id="datepickers2" data-toggle="datetimepicker" data-target="#datepickers2" name="app_date2">  
                            <span id="dateError" class="text-danger"></span>
                        </div>   
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <label for="time_start">Select start time:</label>
                            <input type="text" class ="timepicker" id="time_start" name="time_start"  autocomplete ="off">
                             <span id="startError" class="text-danger"></span>
                        </div>
                        <div class="col"> 
                            <label for="time_end">Select end time:</label>
                             <input type="text" class ="timepicker" id="time_end" name="time_end"  autocomplete ="off">
                            <span id="endError" class="text-danger"></span>      
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="col">
                        <label for="app_interval">Time interval:</label>
                            <select id="app_interval" name="app_interval">
                                <option value="5">5 Minutes</option>
                                <option value="10">10 Minutes</option>
                                <option value="15">15 Minutes</option>
                                <option value="30">30 Minutes</option>
                                <option value="60">1 Hour</option>
                            </select>   
                        </div>
                    </div>
                         

                        
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn" class="btn btn-primary">Submit</button>
                </form>
            </div>
               
            </div>
        </div>
        </div>

<style>
    .modal {
 width: 100%;
 height: 100%;

 justify-content: center;
 align-items: center;
}
</style>