       <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doctor information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" style="text-align: justify;">
                    <p style="text-align: center;"><img src="{{asset('images')}}/{{$user->user_image}}" class="table-user-thumb" alt="" width="200`"></p>
                    <p class="badge badge-pill badge-dark">Role:{{$user->role->name}}</p>
                    <p><strong>Firstname:</strong> {{$user->user_fName}}</p>
                    <p><strong>Lastname:</strong> {{$user->user_lName}}</p>
                    <p><strong>Gender:</strong> {{$user->user_gender}}</p>
                    <p><strong>Email:</strong> {{$user->email}}</p>
                    <p><strong>Address:</strong> {{$user->user_address}}</p>
                    <p><strong>Phone Number:</strong> {{$user->user_phoneNum}}</p>
                    <p><strong>Department:</strong> {{$user->user_department}}</p>
                  </div>
                  <div class="modal-footer">
                      <div class="col text-center">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
 