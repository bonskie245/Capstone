<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Urgent Care Clinic') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"defer></script>

   <!--for datepicker-->
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>
      
    <!--for datepicker-->

        

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/dist/css/theme.min.css')}}">
  


   <!--for datepicker-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <!--for datepicker-->

     <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-blue shadow-sm">
            <div class="container">
                <a style="color: #fff;font-weight: bold;" class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Urgent Care Clinic')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if(auth()->check()&& auth()->user()->role->name === 'patient')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my.booking') }}" style="color: #fff; font-size:16px; font-weight: bold;">{{ __('My Booking') }}</a>
                            </li>
                        @endif
                        @if(auth()->check()&& auth()->user()->role->name === 'patient')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('myPrescription') }}" style="color: #fff; font-size:16px; font-weight: bold;">{{ __('My Prescription') }}</a>
                            </li>
                        @endif 
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a style="color: #fff; font-size:16px; font-weight: bold;"  class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="color: #fff; font-size:16px; font-weight: bold;" class="nav-link" href="{{ route('register') }}" style="color: #fff; font-size:16px; font-weight: bold;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a style="color: #fff; font-size:16px; font-weight: bold;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#"  role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->lName }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     @if(auth()->check() && auth()->user()->role->name === 'patient')
                                    <a href="{{url('user-profile')}}"  class="dropdown-item"style="color: #000; font-size:14px; font-weight: normal">Profile</a>
                                    @else 
                                     <a href="{{url('dashboard')}}"  class="dropdown-item">Dashboard</a>
                                    @endif
                                    <a style="color: #000; font-size:14px; font-weight: normal;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
        </nav>

        <main class="py-4">

            @yield('content')
        </main>
    </div>
        


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
        background: red;
        color: #fff;
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
    .navbar{
        background:#0099CC!important;
        color: #fff!important;
         text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }
</style>
  
</body>
</html>
