       <div class="modal fade" id="deleteModal{{$medicine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" style="text-align: justify;">
                  <p></p>
                  <h4 style="text-align: center;">Are you sure to delete</h4>
                  <h5 style="text-align: center;"><strong>{{$medicine->medicine_name." ". $medicine->medicine_dosage."/". $medicine->medicine_type. " ?"}}</strong></h5>
  				      <form class="forms-sample" action="{{route('medicine.destroy',[$medicine->id])}}" method="POST">@csrf
                    @method('DELETE')
                  </div>
                  <div class="modal-footer">
                      <div class="col text-center">
                          <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal"  class="btn btn-secondary">Close</button>
                      </div>
                  </div>
                </div>
                </form>
              </div>
          </div>
 