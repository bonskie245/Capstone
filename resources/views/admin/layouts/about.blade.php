@extends('admin.layouts.master')

@section('content')
<div class="container">
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-message-square bg-blue"></i>
                        <div class="d-inline">
                            <h5>About us</h5>
                            <span>Aoout us</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">About us</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>

        <div class="row justify-content-center">
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
                    @if(Session::has('errmessage'))
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{Session::get('errmessage')}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endif
                    @foreach($errors->all() as $error)
                        <!-- <div class="alert alert-danger">
                            {{$error}}                        
                        </div>   -->
                        <script>
                            Swal.fire({
                              title: 'Error',
                              text: '{{$error}}',
                              icon: 'error',
                              confirmButtonText: 'Okay  '
                            })
                        </script> 
                    @endforeach
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>ABOUT US</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('about.store')}}" method="POST"> 
                            @csrf
                            @if(isset($about))                    
                                <textarea id="summernote" name="about" rows="20" >{{$about->description}}</textarea>
  
                            @else
                                <textarea id="summernote" name="about" rows="20"></textarea>
                            @endif                      
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> Submit</button>  
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
@endsection
