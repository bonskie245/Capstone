@extends('admin.layouts.master')

@section('content')
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>All Secretary</h5>
                            <span>Delete</span>
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
                                    <a href="#">Secretary</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>


  <div class="row justify-content-center">
  		<div class="col-lg-4">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
  			<div class="card-header" align="center">
  				<h3>Delete</h3>
  			</div>
  			<div class="card-body" align="center">
                <img src="{{asset('images')}}/{{$user->user_image}}" width="120px">
                <p></p>
                <h4>Are you sure to delete</h4>
                <h5><strong>{{$user->user_fName." ". $user->user_lName."?"}}</strong></h5>
  				<form class="forms-sample" action="{{route('receptionist.destroy',[$user->id])}}" method="POST">@csrf
                    @method('DELETE')

                        <div class="card-footer">
  					 		<button type="submit" class="btn btn-danger mr-2">Confirm</button>
	                        <a href="{{route('receptionist.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
				</div>
  			</form>

  			</div>
  		</div>
  </div>
@endsection