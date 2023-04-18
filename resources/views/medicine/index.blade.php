@extends('admin.layouts.master')

@section('content')
<div class="container:">
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
                            <script>
                                    Swal.fire({
                                        title: 'Success',
                                        text: '{{Session::get('message')}}',
                                        icon: 'success',
                                        confirmButtonText: 'Okay  '
                                    })
                            </script>
                            @endif
                            <div class="card-header"><h3>Medicine</h3>
                                <a href="{{route('medicine.create')}}" style=" float: right; margin-left: 65%;" class="btn btn-primary">Add Medicine</a>
                                <a href="{{route('import.index')}}" style=" float: right; margin-left: 1%; " class="btn btn-success">Import File</a>
                            </div>
                              <div class="card-body">
                                 <table id="data_tables" class="table table-hover" style="width:100%">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Medicine ID</th>
                                        <th>Medicine Name</th>
                                        <th class="nosort">Medicine Dosage</th>
                                        <th class="nosort">Medicine type</th>
                                      
                                        <th class="nosort">&nbsp;</th>
                                        <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                             <tbody>
                                @if(count($medicines)>0)
                                @foreach($medicines as $medicine)
                            <tr>
                                <td scope="row">{{$medicine->id}}</td>
                                <td scope="row">{{$medicine->medicine_name}}</td>
                                <td scope="row">{{$medicine->medicine_dosage}}</td>
                                <td scope="row">{{$medicine->medicine_type}}</td>
                                <td scope="row"></td>
                                <td scope="row">
                                    <div class="table-actions" style="margin: right 20px;">
                                    <a href="{{route('medicine.edit',[$medicine->id])}}"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$medicine->id}}"><button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button> </a>
                                    </div>
                                </td>
                            </tr>
                            @include('medicine.modelDelete')
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
</div>
@endsection