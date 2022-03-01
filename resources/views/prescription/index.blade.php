@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Appointments({{$bookings->count()}})</div></strong>
                
                </div>
                <div class="card-body">
                   <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Date</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Time</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($bookings as $key=>$booking)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="{{asset('profile')}}/{{$booking->user->image}}"
                              width="80" style="border-radius: 50%;"></td>
                          <td>{{$booking->date}}</td>
                          <td>{{$booking->user->lName}} ,  {{$booking->user->fName}}</td>
                          <td>{{$booking->user->email}}</td>
                          <td>{{$booking->user->phoneNum}}</td>
                          <td>{{$booking->time}}</td>
                          <td>Dr.{{$booking->doctor->lName}}, {{$booking->doctor->fName}}</td>
                          
                          <td>@if($booking->status===1)
                                Visited
                            @endif
                          </td>   
                          <td>
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                  Write Prescription
                                </button>
                          </td>
                        </tr>
                        @empty
                        <td>No appointments Today</td>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <input type="hidden" name="user_id" value="{{$booking->user_id}}">
        <input type="hidden" name="doctor_id" value="{{$booking->doctor_id}}">
        <input type="hidden" name="date" value="{{$booking->date}}">

        <div class="form-group">
            <label>Findings</label>
            <input type="text" name="findings" class="form-control">
        </div>
        <div class="form-group">
            <label>Medicine</label>
            <input type="text" name="medicine_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Grams</label>
            <input type="text" name="medicine_gram" class="form-control">
        </div>
        <div class="form-group">
            <label>Medicine Intake</label>
            <textarea name="medicine_intake" class="form-control" placeholder="Intake" required=""></textarea>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection
