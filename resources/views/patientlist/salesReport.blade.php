@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-file bg-blue"></i>
                    <div class="d-inline">
                        <h5>Report</h5>
                        <span>Total Charged Report</span>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
        </div>
    </div>

                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            @if(Session::has('errmessage'))
                                <div class="alert alert-danger">
                                 {{Session::get('errmessage')}}
                                </div>
                            @endif

    <div class="container" style="height: 100%;">
    <div class="row">
    <div class="card" style="width: 35%; height: 30%;">
        <div class="card-header"><h3>Filter by Year:</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form action="{{route('charge.index')}}" method="get">
                    @csrf
                        <select name="years" id="yearpicker" style="width: 100%"></select>     
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
        <div class="card" style="">
            <div class="card-header">Charged Report</div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="data_tables" class="table" style="width: 100%; margin:auto; ">
                    <thead>
                        <tr>
                        <th scope="col">Month / Year</th>
                        <th scope="col">Charge</th>
                        </tr>
                    </thead>
<!-- CHECKPOINT APRIL 16, 2023 -->
                    @foreach($data as $data)
                    <tbody>
                        <tr>
                           <td>{{$data->months}}</td>
                           <td>₱ {{number_format($data->charge, 2)}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
    <!-- end contrainer -->
@endsection
