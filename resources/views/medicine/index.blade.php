@extends('admin.layouts.master')

@section('content')
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-user-md bg-blue"></i>
                        <div class="d-inline">
                            <h5>Medicine</h5>
                            <span>Medicine</span>
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
                                    <a href="#">Medicine</a>
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
                            <div class="card-header"><h3>Medicine</h3>
                                <a href="{{route('medicine.create')}}" style="margin-left: 725px;" class="btn btn-primary">Add Medicine</a>
                            </div>
                              <div class="card-body">
                                 <table id="data_table" class="table table-bordered table-hover">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Medicine ID</th>
                                        <th class="nosort">Medicine Name</th>
                                        <th class="nosort">Medicine Dosage</th>
                                        <th class="nosort">Medicine type</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th> 
                                        <th class="nosort">&nbsp;</th> 
                                     </tr>
                                 </thead>
                             <tbody>
                                @if(count($medicines)>0)
                                @foreach($medicines as $medicine)
                            <tr>
                                <td>{{$medicine->id}}</td>
                                <td>{{$medicine->medicine_name}}</td>
                                <td>{{$medicine->medicine_dosage}}</td>
                                <td>{{$medicine->medicine_type}}</td>
                                <td>
                                    <div class="table-actions" style="margin: right 20px;">
                                        <a href="{{route('medicine.edit',[$medicine->id])}}"><i class="ik ik-edit-2" style="color:green">Edit</i></a>
                                        
                                    </div>
                                </td>
                                <td><form action="{{route('medicine.destroy',[$medicine->id])}}" method="post">@csrf 
                                            @method('DELETE') 
                                            <button type="submit" style="padding: 0;border: none;background: none; color:red;"><i class="ik  ik-trash">Delete</i></button>
                                        </form></td>
                                <td></td>
                                <td></td>
                            </tr>

                            @endforeach
                            @else
                                <td>No Medicine to display</td>
                            @endif
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection