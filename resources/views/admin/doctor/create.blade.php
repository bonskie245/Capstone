@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-plus bg-blue"></i>
                   <div class="d-inline">
                       <h5>Doctor</h5>
                       <span>Add Doctor</span>
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
                       <li class="breadcrumb-item"><a href="#">Doctor</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Create
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
  				<h3>Add Doctor</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('doctor.store')}}" method="POST" enctype="multipart/form-data">@csrf
  					<div class="row">
  						<div class="col-lg-6">
  							<label for="fName">First Name</label>
  							<input type="text" name="fName" class="form-control @error('fName') is-invalid @enderror" placeholder="First Name" value="{{old('fName')}}" required>
  								@error('fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  						</div>
  						<div class="col-lg-6">
  							<label for="lName">Last Name</label>
  							<input type="text" name="lName" class="form-control @error('lName') is-invalid @enderror" placeholder= "Last Name" value="{{old('lName')}}"required>
  								@error('lName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              	@enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="email">Email</label>
  							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
  								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="password">Password</label>
  							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder= "Password" required>
  								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="gender">Gender</label>
  							<select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Select Gender</option>
  								<option value="male">Male</option>
  								<option value="female">Female</option>
  							</select>
  								@error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="address ">Address</label>
  							<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" placeholder="Address"  required>
  								@error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="phoneNum">Phonenumber</label>
  							<input type="text" name="phoneNum" class="form-control @error('phoneNum') is-invalid @enderror" value="{{old('phoneNum')}}" placeholder="Phonenumber"> 
  								@error('phoneNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="department">Specialization</label>
  							<select name="department" class="form-control @error('department') is-invalid @enderror" value="{{old('department')}}" placeholder="" required> 
                                <option value="">Please select</option>
                                <option value="Family-medicine">Family-medicine</option>
                                <option value="Dermatologist">Dermatologist</option>
                                <option value="Pediatrician">Pediatrician</option>
                                <option value="Psychiatrist">Psychiatrist</option>
                                <option value="Neurologist">Neurologist</option>
                            </select>
  								@error('department')
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
				                                <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror" placeholder="Upload Image" name="image" required>
				                                <span class="input-group-append">
				                            @error('image')
                                    			<span class="invalid-feedback" role="alert">
                                      			  <strong>{{ $message }}</strong>
                                    			</span>
                                			@enderror     
	                            	</div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<label>Role</label>
	                        		<select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
	                        			<option>
	                        				@foreach(App\Models\Role::where('name','!=','patient')->get() as $role)
	                        				<option value="{{$role->id}}">{{$role->name}} </option>
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
	                        <a href="{{route('doctor.index')}}" class="btn btn-secondary">Cancel</a>
				</div>
  			</form>

  			</div>
  		</div>
  </div>
@endsection