<div class="modal fade bd-example-modal-xl" id="myModal{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                                <input type="text" name="appID" value="{{$booking->app_id}}">
                                <input type="text" name="doctorId" value="{{$booking->doctor_id}}">
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
