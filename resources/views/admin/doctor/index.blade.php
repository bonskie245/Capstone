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
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="card-header"><h3>Doctor Management</h3>
                                <div class="pull-right">
                                <a href="{{route('doctor.create')}}" style="margin-left: 750px;" class="btn btn-primary">Add Doctor</a>
                                </div>
                            </div>
                              <div class="card-body">
                                 <table id="data_table" class="table table-bordered table-hover" style="font-size: 15px;">
                                   <thead>
                                    <tr>
                                        
                                    <th class="nosort">Avatar</th>
                                        <th>Lastname</th>
                                        <th class="nosort">Firstname</th>
                                        <th class="nosort">Email</th>
                                        <th class="nosort">PhoneNumber</th>
                                        <th class="nosort">Specialization</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th>
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
                                    <div class="table-actions">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}" style="color:blue"> 
                                            <i class="ik ik-eye"></i>
                                        </a>
                                        <a href="{{route('doctor.edit',[$user->id])}}"><i class="ik ik-edit-2" style="color:green"></i></a>
                                        <a href="{{route('doctor.show',[$user->id])}}"><i class="ik ik-trash-2" style="color:red"></i></a>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                             <!-- View Modal -->
                            @include('admin.doctor.model')
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