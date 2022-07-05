<!DOCTYPE html>
<html lang="en">
<head>

     <title>Urgent Care Clinic</title>
<!--

Template 2098 Health

http://www.tooplate.com/view/2098-health

-->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
     <link rel="stylesheet" href="{{asset('welcome/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/font-awesome.min.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/animate.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/owl.carousel.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/owl.theme.default.min.css')}}">
     <!-- MAIN CSS -->
     <link rel="stylesheet" href="{{asset('welcome/css/tooplate-style.css')}}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
     
     <!-- Datepicker -->
     
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     
</head>


<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


<!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">
                    <div class="col-md-4 col-sm-5">
                         <p>Welcome Urgent Care Clinic</p>
                    </div>
                    <div class="col-md-8 col-sm-7 text-align-right">
                         <span class="phone-icon"><i class="fa fa-phone"></i> 010-060-0160</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 10:00 AM - 5:00 PM (Mon-Sat)</span>
                    </div>

               </div>
          </div>
     </header>
     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">
               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>
                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand"><i class=""></i>Urgent Care Clinic</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="{{ route('welcome') }}" class="smoothScroll">Home</a></li>
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
                         <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->user_lName }} 
                                   </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              @if(auth()->check() && auth()->user()->role->name === 'patient')
                                   <a class="dropdown-item" href="{{url('user-profile')}}">Profile</a>
                              @else
                              <a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a>
                              @endif
                              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                              </div>
                         </li>
                         @endguest
                    </ul>
               </div>
          </div>
     </section>

     <main class="py-4">
          @yield('content')
     </main>
     
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

input[type="text"]{
     font-size: 15px;
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
     @include('layouts.footer')
       <!-- SCRIPTS -->
     <script src="{{asset('welcome/js/jquery.js')}}"></script>
     <script src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('welcome/js/jquery.sticky.js')}}"></script>
     <script src="{{asset('welcome/js/jquery.stellar.min.js')}}"></script>
     <script src="{{asset('welcome/js/wow.min.js')}}"></script>
     <script src="{{asset('welcome/js/smoothscroll.js')}}"></script>
     <script src="{{asset('welcome/js/owl.carousel.min.js')}}"></script>
     <script src="{{asset('welcome/js/custom.js')}}"></script>

     </body>
</html>



     

