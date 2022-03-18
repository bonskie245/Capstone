@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-hospital bg-blue"></i>
                   <div class="d-inline">
                       <h5>Department</h5>
                       <span>Update Department</span>
                   </div>
               </div>
           </div>
           <div class="col-lg-4">
               <nav class="breadcrumb-container" aria-label="breadcrumb">            
               		<ol class="breadcrumb">        
               			<li class="breadcrumb-item">           
               				<a href="../index.html">
               				<i class="ik ik-home"></i></a>
                        </li>
                       <li class="breadcrumb-item"><a href="#">Departmentr</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Update
            		   </li>
                  </ol>
               </nav>
          </div>
       </div>
  </div>

  <div class="row justify-content-center">
  		<div class="col-lg-10">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
  			<div class="card-header">
  				<h3>Update Department</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('department.update',[$department->id])}}" method="POST" enctype="multipart/form-data">@csrf
                      @method('PUT')
  					<div class="row">
  						<div class="col-lg-6">
  							<label for="dept_name">Department name</label>
  							<input type="text" name="dept_name" class="form-control @error('dept_name') is-invalid @enderror" placeholder="First Name" value="{{$department->dept_name}}" required>
  								@error('dept_name') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>                        
  				      </div>
                        <br>
                        <div class="form-group">
  					 		<button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                  </div>
  			</form>

  			</div>
  		</div>
  </div>
@endsection 