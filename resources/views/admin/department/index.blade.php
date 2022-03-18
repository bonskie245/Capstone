@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>Department</h5>
                            <span>Department</span>
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
                                    <a href="#">Department</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="card-header"><h3>Department</h3>
                                <a href="{{route('department.create')}}" style="margin-left: 725px;" class="btn btn-primary">Add Department</a>
                            </div>
                              <div class="card-body">
                                 <table id="data_table" class="table">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Department ID</th>
                                        <th class="nosort">Department Name</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th> 
                                     </tr>
                                 </thead>
                             <tbody>
                                @if(count($departments)>0)
                                @foreach($departments as $department)
                            <tr>
                                <td>{{$department->id}}</td>
                                <td>{{$department->dept_name}}</td>
                                <td>
                                    <div class="table-actions" style="margin: right 20pxl;">
                                        <a href="{{route('department.edit',[$department->id])}}"><i class="ik ik-edit-2" style="color:green"></i></a>
                                        <form action="{{route('department.destroy',[$department->id])}}" method="post">@csrf 
                                            @method('DELETE') 
                                            <button type="submit"><i class="ik  ik-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

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