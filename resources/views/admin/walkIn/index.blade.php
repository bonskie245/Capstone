@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-book bg-blue"></i>
                        <div class="d-inline">
                            <h5>Prescription Walk-in</h5>
                            <span>Prescription Tab</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('doctor.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Prescription</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 20px;"><strong>Walk-ins:({{$bookings->count()}})</div></strong>
                
                <div class="card-body">
                   <table id="data_table" class="table table-hover " style="font-size: 15px;">
                   <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Date</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Action</th>
                          <th class="nosort">&nbsp;</th>
                          <th class="nosort">&nbsp;</th>

                        </tr>
                      </thead>
                      @forelse($bookings as $key => $booking)
                      <tbody>
                            
                          <td>{{$key+1}}</td>
                          <td>{{$booking->user->user_fName}}</td>
                            @if(!$booking->user->user_image)
                          <td><img src="{{asset('images/user.png')}}"
                                width="80" style="border-radius: 50%;"></td>
                            @else
                          <td><img src="{{asset('profiles')}}/{{$booking->user->user_image}}"
                                width="80" style="border-radius: 50%;"></td>
                            @endif
                          <td>{{$booking->user->email}}</td>
                          <td>{{$booking->user->user_phoneNum}}</td>
                          <td>{{$booking->app_date}}</td>
                          <td>Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_fName}}, {{$booking->doctor->doctor_title}}</td>
                          <td>
                              @if(!App\Models\Prescription::where('app_date',date('Y-m-d'))->where('doctor_id',$booking->doctor_id)->where('user_id',$booking->user_id)->exists())
                                 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$booking->user_id}}">
                                  Write Prescription
                                </button> -->
                                <button type="button" class = "btn btn-primary"><a href="{{route('patient.presCreate',[$booking->user_id,$booking->app_date,$booking->doctor_id])}}">Write Prescription</a></button>                             
                                @else
                                <a href="{{route('prescription.show',[$booking->user_id,$booking->app_date])}}" class="btn btn-secondary">View Prescription</a>
                                @endif
                          </td> 
                         @empty
                         <td>No data to show</td>
                        </tr>
                      </tbody>
                      @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
