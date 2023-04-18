<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Urgent Care Clinic </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="{{asset('welcome/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/slicknav.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/flaticon.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/gijgo.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/animate.min.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/animated-headline.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/slick.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('welcome/css/style.css')}}">

     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     
</head>
<body>

<header>
    <!--? Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                            <a href="{{route('welcome')}}" style ="color:black; Font-size: 20px">Urgent Care Clinic</a>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="menu-main d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                    <li><a href="{{url('dashboard/users')}}" class="smoothScroll">Home</a></li>
                                   @if(auth()->check()&& auth()->user()->role->name === 'patient')
                                    <li><a class="nav-link" href="{{ route('my.booking') }}" >{{ __('My Booking') }}</a></li>
                                   @endif
                                   @if(auth()->check()&& auth()->user()->role->name === 'patient')
                                   <li><a class="nav-link" href="{{ route('myPrescription') }}">{{ __('My MedicalHistory') }}</a></li>
                                   @endif
                                   <!-- authentication -->
                                   @guest
                                   <li><a href="{{url('about-us')}}" class="smoothScroll">About Us</a></li>
                                   <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                        @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}" class="smoothScroll">Register</a></li>
                                        @endif
                                   @else
                                        <li><a href="#">{{ Auth::user()->user_lName }} </a>
                                            <ul class="submenu">
                                            @if(auth()->check() && auth()->user()->role->name === 'patient')
                                                 <li><a href="{{url('dashboard/users')}}">Profile</a></li>
                                             @else
                                             <li><a href="{{url('dashboard/admin')}}">Dashboard</a></li>
                                             @endif
                                                <li><a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                       {{ __('Logout') }}</a></li>
                                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  @csrf
                                             </form>
                                            </ul>
                                        </li>
                                    </ul>
                                    @endguest
                                </nav>
                            </div>
                        </div>
                    </div>   
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>



    <main class="py-4">
          @yield('content')
     </main>
     
     <style type="text/css">
    body{
        background: #fff;
    }
    .ui-corner-all{
        background: white;
        color: #000;
    }
    label.btn{
        padding: 0;
    }
    label.btn input{
        opacity: 0; 
        position: absolute;
    }
    label.btn span{
        text-align: center; 
        padding: 6px 12px; 
        display: block;
        min-width: 80px;
    }
    label.btn input:checked+span{
        background-color: rgb(80,110,228); 
        color: #fff;
    }
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  font-size: 16px;
}
input[type="text"]{
     font-size: 15px;
}
html {
  box-sizing: border-box;
  scroll-behavior: smooth;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 10px;
  margin: auto;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
  margin: auto;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}



.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}

</style>
@include('layouts.footer2')
     <script>
          var dateToday = new Date();
          $( function() {
          $("#datepicker").datepicker({
               dateFormat:"yy-mm-dd",
               showButtonPanel:true,
               numberOfMonths:2,
               minDate:dateToday,
          });
          });
   </script>


<script src="{{asset('welcome/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{asset('welcome/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('welcome/js/popper.min.js')}}"></script>
    <script src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{asset('welcome/js/jquery.slicknav.min.js')}}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{asset('welcome/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('welcome/js/slick.min.js')}}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{asset('welcome/js/wow.min.js')}}"></script>
    <script src="{{asset('welcome/js/animated.headline.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.magnific-popup.js')}}"></script>

    <!-- Date Picker -->
    <script src="{{asset('welcome/js/gijgo.min.js')}}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{asset('welcome/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.sticky.js')}}"></script>
    
    <!-- counter , waypoint -->
    <script src="{{asset('welcome/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('welcome/js/waypoints.min.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.countdown.min.js')}}"></script>
    <!-- contact js -->
    <script src="{{asset('welcome/js/contact.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.form.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('welcome/js/mail-script.js')}}"></script>
    <script src="{{asset('welcome/js/jquery.ajaxchimp.min.js')}}"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="{{asset('welcome/js/plugins.js')}}"></script>
    <script src="{{asset('welcome/js/main.js')}}"></script>
     </body>
     </html>