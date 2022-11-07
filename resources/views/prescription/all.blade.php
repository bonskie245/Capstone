@extends('admin.layouts.master')

@section('content')
<!-- <div class="container"> -->
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-book bg-blue"></i>
                        <div class="d-inline">
                            <h5>Medical History</h5>
                            <span>Medical History</span>
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
                                    <a href="#">Medical History</a>
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
              @if(Session::has('message'))
              <div class="alert alert-success"> 
                {{Session::get('message')}}
              </div>
              @endif
               
              <div class="card-header" style="font-size: 20px;"><strong>Total Patients: ({{$patients->count()}})</div></strong>
                <div class="card-body">
                   <table id="data_table"class="table table-bordered table-hover" style="font-size: 15px;">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Address</th>
                          <th scope="col">Action</th>
                          <th class="nosort">&nbsp;</th>
                          <th class="nosort">&nbsp;</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($patients as $key => $patient)
                          <tr>
                            <td>{{$key+1}}</td>
                            @if(!$patient->user_image)
                            <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                            @else
                            <td><img src="{{asset('profiles')}}/{{$patient->user_image}}"  style="width: 50px; height: 50px; border-radius: 50%;" class="table-user-thumb" alt=""></td>
                            @endif
                            <td>{{$patient->user_fName}}</td>
                            <td>{{$patient->user_lName}}</td>
                            <td>{{$patient->user_phoneNum}}</td>
                            <td>{{$patient->user_address}}</td>
                            <td>
                              <div class="table-actions">
                            <a href="{{route('medical.show',[$patient->id])}}" style="color: white;"class ="btn btn-primary">View history</a>
                                    </div>
                                  </td>
                                  <td></td><td></td>
                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
