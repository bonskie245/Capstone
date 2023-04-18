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
                                <a href="{{route('login')}}" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.5s" style="width: 23%;  font-size: 12px;">Login now</a>
                                <a href="{{route('register')}}" class="btn hero-btn" data-animation="fadeInRight" data-delay="0.5s"  style="width:28%; font-size: 12px;">Sign-Up now</a>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
    <!-- slider Area End-->
<br>
<br>
<br>
<br>
@endsection
