@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
  		<div class="col-lg-4">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

            <div class="card">
  			<div class="card-header" align="center">
  				<h3>Delete</h3>
            </div>
            <div class="card-body" align="center">
                <p></p>
                <h4>Are you sure to delete</h4>
                @foreach($bookings->appointment as $appointment)
                <h5><strong>{{date('h:i A', strtotime($appointment->time_start))}} - {{date('h:i A', strtotime($appointment->time_end))}} ?</strong></h5>
                @endforeach
  				<form class="forms-sample" action="{{route('booking.deleteBooking',[$bookings->id])}}" method="POST">@csrf
                    @method('DELETE')
                    </div>
                        <div class="card-footer" align="center">
  					 		<button type="submit" class="btn btn-danger mr-2">Confirm</button>
	                        <a href="{{route('my.booking')}}" class="btn btn-secondary">Cancel</a>
                        </div>
  			</form>
              </div>
  			</div>
  		</div>
  </div>
@endsection