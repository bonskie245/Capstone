<div class="modal fade" id="exampleModal{{$doctor->doctor_id . '-' . $doctor->app_date}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{$doctor->doctor->user->user_fName}}</p>
        @forelse($doctors as $appointment)
            <p>{{$appointment->app_date}}</p>
            <p>{{$appointment->time_start}}</p>
            @empty
            <p></p>
        @endforelse
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>