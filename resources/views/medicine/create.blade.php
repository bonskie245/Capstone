@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-hospital bg-blue"></i>
                   <div class="d-inline">
                       <h5>Medicine</h5>
                       <span>Add Medicine</span>
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
                       <li class="breadcrumb-item"><a href="#">Medicine</a>
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
            <div class="card border-dark mb-3">
            <div class="card">
  			<div class="card-header">
  				<h2>Add Medicine</h2>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('medicine.store')}}" method="POST" enctype="multipart/form-data">@csrf
  					<div class="row">
  						<div class="col-lg-12">
  							<label for="medicine_name">Medicine Name</label>
  							<input type="text" name="medicine_name" class="form-control @error('medicine_name') is-invalid @enderror" placeholder="First Name" value="{{old('dept_name')}}" required>
  								@error('medicine_name') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <label for="medicine_dosage">Medicine Dosage</label>
                                        <input type="number" name="medicine_dosage" class="form-control @error('medicine_dosage') is-invalid @enderror" placeholder="Enter Dosage(Numeric)" autocomplete="off" min="1" required>
                                        @error('medicine_dosage') 
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="medicine_unit">Medicine Dosage</label>
                                        <select name="medicine_unit" class="form-control @error('medicine_dosage') is-invalid @enderror" required>
                                            <option value="">Select Unit</option>
                                            <option value="Kg">kilogram</option>
                                            <option value="g">gram</option>
                                            <option value="mg">milligram</option>
                                            <option value="mcg">microgram</option>
                                            <option value="L">litre</option>
                                            <option value="ml">millilitre</option>
                                            <option value="cc">cubic centimetre</option>
                                            <option value="mol">mole</option>
                                            <option value="mmol">millimole</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="medicine_type">Medicine Type</label>
  							<select name="medicine_type" class="form-control @error('medicine_type') is-invalid @enderror" placeholder="First Name" value="" required>
                              <option value="">Please select Medicine type</option>
                                   <option value="Capsule">Capsule</option>
                                   <option value="Tablet">Tablet</option>
                                   <option value="Liquid">Liquid</option>
                                   <option value="Inhaler">Inhaler</option>
                                   <option value="Ointment">Ointment</option>
                                   <option value="Cream">Cream</option>
                            </select>
  								@error('medicine_type') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>                        
  				      </div>
                        <br>
                        <div class="form-group">
  					 		<button type="submit" class="btn btn-primary mr-2">Submit</button>
  					 		<a href="{{route('medicine.index')}}" class="btn btn-danger mr-2">Cancel</a>
                        </div>
                  </div>
  			
                </form>
              </div>
  			</div>
            </div>
  		</div>
  </div>
@endsection 