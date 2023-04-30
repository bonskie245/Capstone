@extends('admin.layouts.master')

@section('content')
<!-- Last checkpoint march 30,2023 -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>All Patient</h5>
                            <span>Patient information</span>
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
                                    <a href="#">Patients</a>
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

       <!-- Checkpoint April 17, 2023 -->
        <div class="row justify-content-center">
                    <!-- <div class="col-md-12">   -->
                    <div class="container-fluid"> 
                        <div class="card" style="overflow-x:auto">
                            <div class="card-header"><h3>Patient Management</h3>
                                    <a href="{{route('patient.create')}}" style="float:right; margin-left: 60%;" class="btn btn-primary">Add Patient</a>
                                <a href="{{route('walkIn.index')}}" style="margin-left: 1%;" class="btn btn-primary">Book Patient</a>
                            </div>
                              <div class="card-body">
                                 <table id="data_table" class="table table-hover" style="font-size: 14px; width:100%; margin: auto;"  >
                                   <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="nosort">Avatar</th>
                                        <th class="nosort">Email</th>
                                        <th class="nosort">PhoneNumber</th>
                                        <th  colspan="2" class="nosort">Address</th>
                                        <th class="nosort">Gender</th>
                                        <th class="nosort" >Actions</th>
                                        <th  class="nosort"></th>
                                        <!-- <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th> -->
                                     </tr>
                                 </thead>
                             <tbody>
                                @if(count($users)>0)
                                @foreach($users as $user)
                            <tr>
                                <td>{{$user->user_lName}} {{$user->user_fName}}</td>
                                @if(!$user->user_image)
                                <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @else
                                <td><img src="{{asset('profiles')}}/{{$user->user_image}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @endif
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_phoneNum}}</td>
                                <td>{{$user->user_address}}</td>
                                <td></td>
                                <td>{{ucfirst($user->user_gender)}}</td>
                                <td>
                                        <!-- <i class="ik ik-edit-2" style="color:green"></i> -->
                                        <a href="{{route('patient.edit',[$user->id])}}"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal{{$user->id}}" style="color:blue"><button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button> </a>
                                </td>
                                <td>                                 
                                </td>
                            </tr>
                            @include('patient.modelDelete')
                            @endforeach
                            
                            @else
                                <td>No user to display</td>
                            @endif
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection