@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>All Staff</h5>
                            <span>Staff information</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('receptionist.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Staffs</a>
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
                            <div class="card-header"><h3>Staff Management</h3>
                                <a href="{{route('receptionist.create')}}" style=" float: right; margin-left: 75%;" class="btn btn-primary">Add Staff</a>
                            </div>
                              <div class="card-body">
                              <table id="data_tables" class="table table-hover" style="font-size: 15px; width: 100%">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Avatar</th>
                                        <th>Lastname</th>
                                        <th class="nosort">Firstname</th>
                                        <th class="nosort">Email</th>
                                        <th>PhoneNumber</th>
                                        <th class="nosort">Action</th>
                                     </tr>
                                 </thead>
                             <tbody>
                            
                                @foreach($users as $user)
                            <tr>
                                @if(!$user->user_image)
                                <td><img src="{{asset('images/user.png')}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @else
                                <td><img src="{{asset('profiles')}}/{{$user->user_image}}" class="table-user-thumb" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                @endif
                                <td>{{$user->user_lName}}</td>
                                <td>{{$user->user_fName}}</td>        
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_phoneNum}}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}"><button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button> </a>
                                        <a href="{{route('receptionist.edit',[$user->id])}}"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal{{$user->id}}"> <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button> </a> 
                                    </div>
                                </td>
                            </tr>

                             <!-- View Modal -->
                            @include('admin.receptionist.model')
                            @include('admin.receptionist.modelDelete')
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection