@extends('admin.layouts.master')

@section('content')
<div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-clock bg-blue"></i>
                   <div class="d-inline">
                       <h5>Walk-In / Call Appointment</h5>
                       <span>Appointment</span>
                   </div>
               </div>
           </div>
           
           <div class="col-lg-4">
               <nav class="breadcrumb-container" aria-label="breadcrumb">            
               		<ol class="breadcrumb">        
               			<li class="breadcrumb-item">           
               				<a href="#">
               				<i class="ik ik-home"></i></a>
                        </li>
                       <li class="breadcrumb-item"><a href="#">Appointment</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Make Appointment
            		   </li>
                  </ol>
               </nav>
          </div>
       </div>
  </div>
    
  <div class="row justify-content-center">
  		<div class="col-lg-10">        
  			<div class="card-header">
  				<h3>Add Walk-In Patient</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('walkIn.store')}}" method="POST" enctype="multipart/form-data">@csrf
  					<div class="row">
  						<div class="col-lg-6">
  							<label for="patient_fName">First Name</label>
  							<input type="text" name="patient_fName" class="form-control @error('patient_fName') is-invalid @enderror" placeholder="First Name" value="{{old('patient_fName')}}" required>
  								@error('patient_fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  						</div>
  						<div class="col-lg-6">
  							<label for="patient_lName">Last Name</label>
  							<input type="text" name="patient_lName" class="form-control @error('patient_lName') is-invalid @enderror" placeholder= "Last Name" value="{{old('patient_lName')}}"required>
  								@error('patient_lName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              	@enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="patient_gender">Gender</label>
  							<select class="form-control @error('patient_gender') is-invalid @enderror" name="patient_gender" required>
                                <option value="">Select Gender</option>
  								<option value="male">Male</option>
  								<option value="female">Female</option>
  							</select>
  								@error('patient_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-lg-6">
  							<label for="patient_address ">Address</label>
  							<input type="text" name="patient_address" class="form-control @error('patient_address') is-invalid @enderror" value="{{old('address')}}" placeholder="Address"  required>
  								@error('patient_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
  						<div class="col-md-6">
  							<label for="patient_phoneNum">Phonenumber</label>
  							<input type="text" name="patient_phoneNum" class="form-control @error('patient_phoneNum') is-invalid @enderror" value="{{old('phoneNum')}}" placeholder="Phonenumber"> 
  								@error('patient_phoneNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
  						</div>
		  			</div>

              
				</div>
  					 		<button type="submit" class="btn btn-primary mr-2">Submit</button>
	                        <a href="{{route('walkIn.index')}}" class="btn btn-secondary">Cancel</a>
  			</form>

  			</div>
  		</div>
  </div>
@endsection