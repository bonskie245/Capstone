@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-edit bg-blue"></i>
                   <div class="d-inline">
                       <h5>Patient</h5>
                       <span>Update Patient</span>
                   </div>
               </div>
           </div>
           <div class="col-lg-4">
               <nav class="breadcrumb-container" aria-label="breadcrumb">            
               		<ol class="breadcrumb">        
               			<li class="breadcrumb-item">           
               				<a href="{{route('patient.index')}}">
               				<i class="ik ik-home"></i></a>
                        </li>
                       <li class="breadcrumb-item"><a href="#">Patient</a>
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
  				<h3>Update Patient</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('patient.update',[$users->id])}}" method="POST" enctype="multipart/form-data">@csrf
                    @method('PUT')
  					<div class="row">
  						<div class="col-lg-6">
  							<label for="user_fName">First Name</label>
  							<input type="text" name="user_fName" class="form-control @error('user_fName') is-invalid @enderror" placeholder="First Name" value="{{$users->user_fName}}" required>
  								@error('user_fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  						</div>
  						<div class="col-lg-6">
  							<label for="user_lName">Last Name</label>
  							<input type="text" name="user_lName" class="form-control @error('user_lName') is-invalid @enderror" placeholder= "Last Name" value="{{$users->user_lName}}"required>
  								@error('user_lName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              	@enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="email">Email</label>
  							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{$users->email}}" required>
  								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="password">Password</label>
  							<input type="password" name="password" class="form-control " placeholder= "Password">
  						</div>
  						<div class="col-lg-6">
  							<label for="user_gender">Gender</label>
  							<select class="form-control @error('user_gender') is-invalid @enderror" name="user_gender" required>
                               @foreach(['male','female'] as $gender)
                               <option value="{{$gender}}" @if($users->user_gender==$gender)selected @endif>{{$gender}}</option>
                               @endforeach
  							</select>
  								@error('user_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="user_address ">Address</label>
  							<input type="text" name="user_address" class="form-control @error('user_address') is-invalid @enderror" value="{{$users->user_address}}" placeholder="Address"  required>
  								@error('user_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="user_phoneNum">Phonenumber</label>
  							<input type="text" name="user_phoneNum" class="form-control @error('user_phoneNum') is-invalid @enderror" value="{{$users->user_phoneNum}}"
                             placeholder="Phonenumber"> 
  								@error('user_phoneNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
		  			</div>
		  			<div class="row">
	                            <div class="col-md-6">
	                            	<div class="form-group">
		                            		<label>Photo</label>
				                                <input type="file" class="form-control file-upload-info" name="user_image">
				                                <span class="input-group-append">   
	                            	</div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<label>Role</label>
	                        		<select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
	                        			<option>
                                        	@foreach(App\Models\Role::where('name','!=','Doctor')->where('name','!=','admin')->where('name','!=','receptionist')->get() as $role)
	                        				<option value="{{$role->id}}"@if($users->role_id==$role->id)selected @endif>{{$role->name}} </option>
	                        				@endforeach
	                        			</option>
	                        		</select>
	                        			@error('role_id')
                                   		 <span class="invalid-feedback" role="alert">
                                       		 <strong>{{ $message }}</strong>
                                    	</span>
                                		@enderror 
	                        	</div>
  					</div>
  					 		<button type="submit" class="btn btn-primary mr-2">Submit</button>
	                        <a href="{{route('patient.index')}}" class="btn btn-light">Cancel</a>
  			</form>

  			</div>
  		</div>
  </div>
@endsection