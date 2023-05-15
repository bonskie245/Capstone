@extends('layouts.app')

@section('content')
     <!--? slider Area Start-->
     <div class="slider-area position-relative">
     <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center"  style="height: 650px; width: 100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                            <div class="hero__caption">
                                <span>Welcome to Urgent Care Clinic Appointment System</span>
                                <h1 class="cd-headline letters scale">Sign-in and make your appointment now</h2>
                                @guest
                                <a href="{{route('login')}}"  data-animation="fadeInLeft" class="btn btn-hero" data-delay="0.5s" style="width: 30%; height: 50%; font-size: 12px; ">Login now</a>
                                <a href="{{route('register')}}"  data-animation="fadeInRight" class="btn btn-hero" data-delay="0.5s"  style="width:30%; font-size: 12px; ">Sign-Up now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <hr>
    <div class="row">
            <div class="mapouter">
            <div class="gmap_canvas">
                <center><iframe width="80%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=P valero St., Valencia City, 8709 Bukidnon, Philippines&t=&z=20&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></center>
                    <br>
                    <style>.mapouter{position:relative;text-align:right;height:100%;width:100%;}</style><style>.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}
                </style>
                </div>
            </div>                       
    </div>
     
<br>
<br>
<br>
<br>
@endsection
