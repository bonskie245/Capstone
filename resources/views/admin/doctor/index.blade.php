@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>All Doctor</h5>
                            <span>Doctor information</span>
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
                                    <a href="#">Doctors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>


            <div class="row">
                    <div class="col-md-12">
                    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
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
                            <div class="card-header"><h3>Doctor Management</h3>
                                
                                <a href="{{route('doctor.create')}}" style=" float: right; margin-left: 65%;" class="btn btn-primary">Add Doctor</a>
                               
                            </div>
                              <div class="card-body">
                                 <table id="data_tables" class="table  table-hover" style="font-size: 12px; width: 100%">
                                   <thead>
                                    <tr>                                      
                                        <th class="nosort">Avatar</th>
                                        <th>Lastname</th>
                                        <th class="nosort">Firstname</th>
                                        <th class="nosort">Email</th>
                                        <th class="nosort">PhoneNumber</th>
                                        <th class="nosort">Specialization</th>
                                        <th class="nosort">Action</th>
                                     </tr>
                                 </thead>
                             <tbody>
                                @if(count($users)>0)
                                @foreach($users as $user)
                            <tr>
                                @if(!$user->user_image)
                                <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @else
                                <td><img src="{{asset('images')}}/{{$user->user_image}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @endif
                                <td>{{$user->user_lName}}</td>
                                <td>{{$user->user_fName}}</td>
                              
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_phoneNum}}</td>
                                <td>{{$user->user_department}}</td>
                                <td>
                                    <div class="table-actions" >
                                    <a href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}"><button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button> </a>
                                    <a href="{{route('doctor.edit',[$user->id])}}"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$user->id}}"> <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button> </a> 
                                    </div>
                                </td>
                            </tr>

                             <!-- View Modal -->
                            @include('admin.doctor.model')
                            @include('admin.doctor.modelDelete')
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