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
                    <div class="col-md-11">
                        <div class="card">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="card-header"><h3>Doctor Management</h3>
                                <a href="{{route('doctor.create')}}" style="margin-left: 725px;" class="btn btn-primary">Add Doctor</a>
                            </div>
                              <div class="card-body">
                                 <table id="data_table" class="table">
                                   <thead>
                                    <tr>
                                        <th>Lastname</th>
                                        <th class="nosort">Firstname</th>
                                        <th class="nosort">Avatar</th>
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
                                <td>{{$user->lName}}</td>
                                <td>{{$user->fName}}</td>
                                <td><img src="{{asset('images')}}/{{$user->image}}" class="table-user-thumb" alt=""></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phoneNum}}</td>
                                <td>{{$user->department}}</td>
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