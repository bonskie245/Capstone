@extends('admin.layouts.master')

@section('content')
 <div class="page-header">
     <div class="row align-items-end">
          <div class="col-lg-8">
	               <div class="page-header-title">
                   <i class="fas fa-hospital bg-blue"></i>
                   <div class="d-inline">
                       <h5>Symptoms</h5>
                       <span>Add Symptoms</span>
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
                       <li class="breadcrumb-item"><a href="#">Symptoms</a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Create
            		   </li>
                  </ol>
               </nav>
          </div>
       </div>
  </div>

  <div class="row justify-content-center">
  		<div class="col-lg-8">
          @if(Session::has('message'))
            <script>
                Swal.fire({
                    title: 'Success',
                    text: '{{Session::get('message')}}',
                    icon: 'success',
                    confirmButtonText: 'Okay  '
                })
        </script>
        @endif
            <div class="card border-dark mb-3">
  			<div class="card-header">
  				<h3>Add Symptoms</h3>
  			</div>
  			<div class="card-body">
  				<form class="forms-sample" action="{{route('symptoms.store')}}" method="POST" enctype="multipart/form-data">@csrf
  					<div class="row">
  						<div class="col">
  							<label for="dept_name">Symptoms</label>
  							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Symptoms" value="{{old('name')}}" required>
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
  </div>
@endsection 