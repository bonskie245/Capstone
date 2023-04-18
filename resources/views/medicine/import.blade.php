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
  <!-- CHECKPOINT APRIL 18, 2023 -->

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
                        <h2>Add Medicine Thru/ Excel File</h2>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                        <input type="file" class="form-control file-upload-info"  name="file" required>
                        </div>
                        <button class="btn btn-primary">Import data</button>
                    </form>
                    </div>
                </div>
  		</div>
  </div>
@endsection 