@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  		<div class="col-lg-3">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
  			<div class="card-header" align="center">
  				<h3>Delete</h3>
                <p></p>
                <h4>Are you sure to delete</h4>
                @foreach($bookings->appointment as $appointment)
                <h5><strong>{{date('h:i A', strtotime($appointment->time_start))}} - {{date('h:i A', strtotime($appointment->time_end))}} ?</strong></h5>
                @endforeach
  				<form class="forms-sample" action="{{route('booking.deleteBooking',[$bookings->id])}}" method="POST">@csrf
                    @method('DELETE')

                        <div class="card-footer">
  					 		<button type="submit" class="btn btn-danger mr-2">Confirm</button>
	                        <a href="{{route('doctor.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
				</div>
  			</form>

  			</div>
  		</div>
  </div>
@endsection