@if(count($bookings)>0)

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$booking->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <form Action="{{route('prescription.store')}}" method="post">@csrf
    
    <div class="modal-content">
      <div class="modal-header">  
        @foreach($booking->user as $user)
        <h5 class="modal-title" id="exampleModalLabel">Prescription for {{$user->user_fName}} {{$user->user_lName}}</h5>
        @endforeach
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="user_id" value="{{$booking->user_id}}">
        <input type="hidden" name="doctor_id" value="{{$booking->doctor_id}}">
        <input type="hidden" name="app_date" value="{{$booking->app_date}}">

        <div class="form-group">
            <label>Findings</label>
            <input type="text" name="findings" class="form-control">
        </div>
 
            <label>Medicine</label>
        <div class="form-group"> 
            <table class="table table-clean" id="dynamicAddRemove">
                    <tr>
                        <th>Medicine Name</th>
                        <th>Medicine Gram</th>
                        <th>Medicine Intake</th>
                        <th>Action</th>
                    </tr>
                      <tr>
                        <td><input type="text" name="addmore[0]medicine_name" placeholder="Input Medicine" class="form-control"/></td>
                        <td><input type="text" name="addmore[0]medicine_gram" placeholder="Input Grams of Medicine" class="form-control"/></td>
                        <td><input type="text" name="addmore[0]medicine_intake" placeholder="Indicate Intake" class="form-control"/></td>
                        <td><button type="button" name="add" id="add" class="btn btn-outline-primary">Add</button></td>
                      </tr>
            </table>
          </div>
        <!-- <div class="form-group">
            <label>Grams</label>
            <input type="text" name="medicine_gram" class="form-control">
        </div> -->
        <!-- <div class="form-group">
            <label>Medicine Intake</label>
            <textarea name="medicine_intake" class="form-control" placeholder="Intake" required=""></textarea>
        </div> -->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endif
