<div class="modal fade" id="deleteModal{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body"style="text-align: center;" >
                  <h4>Are you sure to Cancel appointment?</h4>
                        @foreach($booking->appointment as $appointment)
                        <h5><strong>{{date('h:i A', strtotime($appointment->time_start))}} - {{date('h:i A', strtotime($appointment->time_end))}} ?</strong></h5>
                        @endforeach
                      <form class="forms-sample" action="{{route('booking.deleteBooking',[$booking->id])}}" method="POST">@csrf
                        @method('DELETE')
                  </div>
                  <div class="modal-footer">
                          <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal"  class="btn btn-secondary">Close</button>
                          </form>
                  </div>
                </div>
                </form>
              </div>
          </div>
 