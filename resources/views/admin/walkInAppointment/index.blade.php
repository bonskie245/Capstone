@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-clock bg-blue"></i>
                        <div class="d-inline">
                            <h5>Walk-in/Call Patient Appointment</h5>
                            <span>Appointment</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('patient')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Appointment</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>
        @if(Session::has('message'))
                          <script>
                            Swal.fire({
                              title: 'Success',
                              text: '{{Session::get('message')}}',
                              icon: 'success',
                              confirmButtonText: 'Okay  '
                            })
                          </script>
                    @endif
                    @if(Session::has('errmessage'))
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{Session::get('errmessage')}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="card-header"><h3>Book an Appointment For: </h3>
                                
                            </div>

                              <div class="card-body">
                                 <table id="data_tables" class="table" style="width: 100%">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Patient Name</th>
                                        <th class="nosort">Gender</th>
                                        <th class="nosort">Address</th>
                                        <th class="nosort">PhoneNumber</th>
                                        <th class="nosort">Action</th>
                                     </tr>
                                 </thead>
                             <tbody>
                                
                                @foreach($users as $user)
                            <tr>
                                <td>{{$user->user_lName}} {{$user->user_fName}}</td>
                                
                                <td>{{$user->user_gender}}</td>
                                <td>{{$user->user_address}}</td>
                                <td>{{$user->user_phoneNum}}</td>
                                <!-- <td>
                                    <div class="table-actions">
                                        <a href="{{route('walkIn.edit',[$user->id])}}"><i class="ik ik-edit-2" style="color:green"></i>edit</a>
                                         <a href="{{route('walkIn.show',[$user->id])}}"><i class="ik ik-trash-2" style="color:red"></i>delete</a>
                                    </div>
                                </td> -->
                                <td>
                                        <button class="btn btn-primary" ><a href="{{route('walkIn.appointment',[$user->id])}}" style=" color: white;">Book appointment</a></button>
                                </td>
                            </tr>


                            @endforeach                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection