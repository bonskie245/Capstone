       <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" style="text-align: justify;">
                  @if(!$user->user_image)
                    <p style="text-align: center;"><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 150px; height: 100px; border-radius: 50%;" alt=""></p>
                  @else
                    <p style="text-align: center;"><img src="{{asset('profiles')}}/{{$user->user_image}}" class="table-user-thumb" style="width: 150px; height: 100px; border-radius: 50%;" alt=""></p>
                  @endif
                  <p></p>
                  <h4 style="text-align: center;">Are you sure to delete</h4>
                  <h5 style="text-align: center;"><strong>{{$user->user_fName." ". $user->user_lName."?"}}</strong></h5>
  				      <form class="forms-sample" action="{{route('receptionist.destroy',[$user->id])}}" method="POST">@csrf
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
 