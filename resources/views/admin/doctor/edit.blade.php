@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-edit bg-blue"></i>
                   <div class="d-inline">
                       <h5>Doctor</h5>
                       <span>Update Doctor</span>
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
  				<h3>Update Doctor</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('doctor.update',[$users->id])}}" method="POST" enctype="multipart/form-data">@csrf
                    @method('PUT')
  					<div class="row">
  						<div class="col-lg-6">
  							<label for="fName">First Name</label>
  							<input type="text" name="fName" class="form-control @error('fName') is-invalid @enderror" placeholder="First Name" value="{{$users->fName}}" required>
  								@error('fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  						</div>
  						<div class="col-lg-6">
  							<label for="lName">Last Name</label>
  							<input type="text" name="lName" class="form-control @error('lName') is-invalid @enderror" placeholder= "Last Name" value="{{$users->lName}}"required>
  								@error('lName')
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
  							<label for="gender">Gender</label>
  							<select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                               @foreach(['male','female'] as $gender)
                               <option value="{{$gender}}" @if($users->gender==$gender)selected @endif>{{$gender}}</option>
                               @endforeach
  							</select>
  								@error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="address ">Address</label>
  							<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$users->address}}" placeholder="Address"  required>
  								@error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="phoneNum">Phonenumber</label>
  							<input type="text" name="phoneNum" class="form-control @error('phoneNum') is-invalid @enderror" value="{{$users->phoneNum}}"
                             placeholder="Phonenumber"> 
  								@error('phoneNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="department">Specialization</label>
  							<select name="department" class="form-control @error('department') is-invalid @enderror" value="{{$users->department}}" placeholder="" required> 
                                @foreach(['Family-medicine','Dermatologist','Pediatrician','Psychiatrist','Neurologist'] as $department)
                               <option value="{{$department}}" @if($users->department==$department)selected @endif>{{$department}}</option>
                               @endforeach

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
				                                <input type="file" class="form-control file-upload-info" name="image">
				                                <span class="input-group-append">   
	                            	</div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<label>Role</label>
	                        		<select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
	                        			<option>
	                        				@foreach(App\Models\Role::where('name','!=','patient')->get() as $role)
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
	                        <a href="{{route('doctor.index')}}" class="btn btn-light">Cancel</a>
  			</form>

  			</div>
  		</div>
  </div>
@endsection