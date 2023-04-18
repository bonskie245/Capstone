@extends('layouts.master')
@section('content')

<div class="container">
    <div class="main-body">   
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if(!auth()->user()->user_image)
                    <img src="{{asset('images/user.png')}}" alt="Admin" class="rounded-circle" width="150"  height="150">
                    @else
                    <img src="{{asset('profiles')}}/{{auth()->user()->user_image}}" alt="Admin" class="rounded-circle" width="150" height="150">
                    @endif
                    <div class="mt-3">  
                      <h4>{{auth()->user()->user_fName}} {{auth()->user()->user_lName}}</h4>
                      <p class="text-secondary mb-1">{{auth()->user()->user_address}}</p>
                      <p class="text-muted font-size-sm">{{auth()->user()->user_phoneNum}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{auth()->user()->user_fName}} {{auth()->user()->user_lName}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{auth()->user()->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{auth()->user()->user_phoneNum}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{auth()->user()->user_address}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info "  href="{{url('/edit/user-profile')}}">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                            <div class="col-md-6">
                                <div class="card task-board">
                                    <div class="card-header">
                                        <h3>Last 3 Bookings</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-rotate-cw reload-card" data-loading-effect="pulse"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body todo-task">
                                        <div class="dd" data-plugin="nestable">
                                            <ol class="dd-list">
                                                @forelse(App\Models\Booking::where('user_id', auth()->user()->id)->where('book_status', '!=', '6')->latest()->paginate(3) as $booking)
                                                <li class="dd-item" data-id="1">
                                                    <div class="dd-handle">
                                                        <h6>Appointment Date: {{$booking->app_date}}</h6>
                                                        <h6>Doctor: Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}, {{$booking->doctor->doctor_title}}</h6>
                                                        @if($booking->book_status==0)
                                                        <h6>Status: <span class="badge badge-pill badge-secondary mb-1">Pending</span></h6>
                                                        @endif
                                                        @if($booking->book_status==1)
                                                        <h6>Status: <span class="badge badge-pill badge-success mb-1">Appointment Accepted</span></h6>
                                                        @endif
                                                        @if($booking->book_status==2)
                                                        <h6>Status: <span class="badge badge-pill badge-primary mb-1">Visited</span></h6>
                                                        @endif
                                                        @if($booking->book_status==3)
                                                        <h6>Status: <span class="badge badge-pill badge-warning mb-1">Did not Visit</span></h6>
                                                        @endif
                                                        @if($booking->book_status==4)
                                                        <h6>Status: <span class="badge badge-pill badge-danger mb-1">Appointment Declined</span></h6>
                                                        @endif
                                                        @if($booking->book_status==5)
                                                        <h6>Status: <span class="badge badge-pill badge-danger mb-1">Appointment Cancelled</span></h6>
                                                        @endif
                                                    </div>
                                                </li>
                                                @empty
                                                <li class="dd-item" data-id="1">
                                                    <div class="dd-handle">
                                                        <h6>You have no booking data</h6>
                                                    </div>
                                                </li>
                                                @endforelse
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Last 3 Medical History</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-rotate-cw reload-card" data-loading-effect="pulse"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body progress-task">
                                        <div class="dd" data-plugin="nestable">
                                            <ol class="dd-list">
                                                @forelse(App\Models\Prescription::where('user_id', auth()->user()->id)->latest()->paginate(3) as $history)
                                                <li class="dd-item" data-id="1">
                                                    <div class="dd-handle">
                                                        <h6>Appointment Date: {{$history->app_date}}</h6>
                                                        <h6>Doctor: {{$history->doctor->user->user_fName}} {{$history->doctor->user->user_lName}}, {{$history->doctor->doctor_title}}</h6>
                                                    </div>
                                                </li>
                                                @empty
                                                <li class="dd-item" data-id="1">
                                                    <div class="dd-handle">
                                                        <h6>You have no history data</h6>
                                                    </div>
                                                </li>
                                                @endforelse
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
          </div>

        </div>
    </div>
</div>

<style>
    body{
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #E2E8F0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

    </style>
@endsection
