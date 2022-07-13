@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-hospital bg-blue"></i>
                   <div class="d-inline">
                       <h5>Medicine</h5>
                       <span>Edit Medicine</span>
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
            <div class="card">
  			<div class="card-header">
  				<h2>Edit Medicine</h2>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('medicine.update',[$medicine->id])}}" method="POST" enctype="multipart/form-data">@csrf
                    @method('PUT')
  					<div class="row">
  						<div class="col-lg-12">
  							<label for="medicine_name">Medicine Name</label>
  							<input type="text" name="medicine_name" class="form-control @error('medicine_name') is-invalid @enderror" placeholder="First Name" value="{{$medicine->medicine_name}}" required>
  								@error('medicine_name') 
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label for="medicine_dosage">Medicine Dosage</label>
  							<input type="text" name="medicine_dosage" class="form-control @error('medicine_dosage') is-invalid @enderror" placeholder="First Name" value="{{$medicine->medicine_dosage}}" required>
  								@error('medicine_dosage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="medicine_type">Medicine Type</label>
  							<select name="medicine_type" class="form-control @error('medicine_type') is-invalid @enderror" placeholder="First Name" value="{{$medicine->medicine_type}}" required>
                              @foreach(['Capsule','Tablet', 'Liquid', 'Inhaler'] as $gender)
                               <option value="{{$gender}}" @if($medicine->medicine_type==$gender)selected @endif>{{$gender}}</option>
                               @endforeach
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
@endsection 