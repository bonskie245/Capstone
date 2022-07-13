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
                                    <a href="#">Walk-In</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>
        
        <div class="row">
                    <div class="col-md-12">
                    <!-- <a href="{{route('patient.index')}}" class="btn btn-primary">back</a> -->
                        <div class="card">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                 {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="card-header"><h2>Walk-In: {{$user->user_fName}} {{$user->user_lName}} </h2>&nbsp;&nbsp;  </div> 
                            <div class="card-body"><h3>Select doctors Below</h3></div> 
                            <br>
                            
                           <div class ="card-columns" style="margin: auto;">
                            @foreach($doctors as $doctor)
                                <div class="card" style="width: 520px;">
                                    @if(!$doctor->user->user_image)
                                    @else
                                    <img class="card-img-top" src="{{asset('images')}}/{{$doctor->user->user_image}}"  style="width: 150px; border-radius: 100%; display: block; margin-left: auto; margin-right: auto; margin-top: 20px; height: 150px;" alt="Card image cap">
                                    @endif
                                    <div class="card-body">
                                    <h5 class="card-title text-center">Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}}</h5>
                                    <p class="card-text text-center" >Department: {{$doctor->doctor_department}} </p>
                                        <div class ="card-footer text-center"> 
                                            <form class="forms-sample" action="{{route('walkin.store')}}" method="POST"> @csrf
                                                <button type="submit" class="btn btn-primary ">Queue</button>
                                                <input type="hidden" name="app_date" value="{{$date}}">
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                </div>
                            </div>
                            </div>
                            
                    </div>
<!--                       
    <table id="data_table" class="table table-hover">
                                   <thead>
                                    <tr>
                                        <th class="nosort">Doctor Name</th>
                                        <th class="nosort">Field</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">&nbsp;</th>
                                        <th class="nosort">Action</th>
                                     </tr>
                                 </thead>
                             <tbody>
                             @foreach($doctors as $doctor)
                            <tr>
                             
                                <td>Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}}</td>
                                <td>{{$doctor->doctor_department}} </td>
                                <td> </td>
                                <td>
                                    <form class="forms-sample" action="{{route('walkin.store')}}" method="POST"> @csrf
                                        <button type="submit" class="btn btn-primary">Queue</button>
                                        <input type="hidden" name="app_date" value="{{$date}}">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                        
                    </table>
                    
                     -->
@endsection