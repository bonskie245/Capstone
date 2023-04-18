<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Urgent Care Clinic - Admin Page</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sunset" viewBox="0 0 16 16">
        <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708l1.5 1.5zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7zm3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{asset('template/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/icon-kit/dist/css/iconkit.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/ionicons/dist/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/weather-icons/css/weather-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/c3/c3.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/owl.carousel/dist/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/plugins/owl.carousel/dist/assets/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/dist/css/theme.min.css')}}">
        <script src="{{asset('template/src/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <!-- Full-Calendar -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />


        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        // <!-- End Full Calendar -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <style>
            body {
        font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 

        }
        </style>
        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                            <div class="header-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                                </div>
                            </div>
                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            
                            <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>{{strtoupper(Auth()->user()->user_fName)}} {{strtoupper(Auth()->user()->user_lName)}}</strong> </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <i class="ik ik-power dropdown-icon"></i>  
                                      {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
           
            </header>
         
            @include('admin.layouts.sidebar')
            <div class="main-content">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                    

                        <div class="page-header-title">
                            <i class="ik ik-command bg-blue"></i>
                            <div class="d-inline">
                                <h5>Doctors</h5>
                                <span>Appoinment time</span>
                                
                            </div>
                        </div>
                    </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                        </ol>
                    </nav>
                </div>
                </div>
            </div>

            <div class="container">
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
                    </div>

                   
                    <div class="card">
                    <input type="hidden" id="doctor_id" name="doctor_id" value="{{App\Models\Doctor::where('user_id', auth()->user()->id)->first()->id}}" />
                        <div class="card-header"><h2>Legend:</h2></div>
                        <div class="card-body">
                        <div class='box blue'> = Available</div>
                        <div class='box red'> = Not Available</div>
                        <br><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appointmentModal">
                        Add Appointment
                        </button>
                        <!-- <a href="{{route('appointment.create')}}" class="btn btn-primary" >Add Appointment</a> -->
                        <!-- <a href="{{route('appointment.timeEdit')}}" class="btn btn-primary" >Edit/Delete Appointment</a> -->
                        </div>
                        <br>
                    </div>
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar">
                                        
                                    </div>
                                </div>
                            </div>
</div>                
        <!-- Modal -->
        @include('admin.appointment.createModal')
        <!-- end modal -->
<!--
            editable: true,

                                    eventDrop: function(event)
                                    {
                                        var id = event.id;
                                        var url ="{{route('appointment.update', '')}}" +'/'+ id;
                                        var app_date = moment(event.start).format('YYYY-MM-DD');
                                        var time_start = moment(event.start).format('hh:mm');
                                        var time_end = moment(event.end).format('hh:mm');
                                
                                        $.ajax
                                        ({
                                            url: url,
                                            type: "PATCH",
                                            dataType: 'json',
                                            data:{ app_date, time_start, time_end},
                                        
                                            success:function(response)
                                            {
                                                console.log(response)
                                            },
                                            error:function(error)
                                            {
                                                console.log(error)
                                            },
                                        });
                                    } -->

        <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="quick-search">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                    <div class="input-wrap">
                                        <input type="text" id="quick-search" class="form-control" placeholder="Search..." />
                                        <i class="ik ik-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="container">
                            <div class="apps-wrap">
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>
                                <div class="app-item dropdown">
                                    <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-command"></i><span>Ui</span></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                                </div>
                                <div class="app-item">
                                    <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .box {
            position: relative;
            margin-left: 20px;
            }
            .box:before{
            position: absolute;
            left: -20px;
            content: "";
            height:20px;
            width:20px;
            margin-bottom:15px;
            border:1px solid black;
            }
            .box.red:before{
            background-color:#b51307;
            }
            .box.blue:before{
            background-color:#47ceff;
            }
          
        </style>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{asset('template/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('template/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('template/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('template/plugins/screenfull/dist/screenfull.js')}}"></script>
        <script src="{{asset('template/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('template/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('template/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('template/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('template/plugins/jvectormap/jquery-jvectormap.min.js')}}"></script>
        <script src="{{asset('template/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('template/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <script src="{{asset('template/plugins/d3/dist/d3.min.js')}}"></script>
        <script src="{{asset('template/plugins/c3/c3.min.js')}}"></script>
        <script src="{{asset('template/js/tables.js')}}"></script>
        <script src="{{asset('template/js/widgets.js')}}"></script>
        <script src="{{asset('template/js/charts.js')}}"></script>
        <script src="{{asset('template/dist/js/theme.min.js')}}"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

           <!-- FULL CALENDAR -->
           <script>
                $(document).ready(function(){
                    $.ajaxSetup(
                    {
                            headers: 
                            {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
                        var appointment = @json($appointment);
                        var doctor = @json($doctors);
                        console.log(appointment)
                        console.log("{{$doctors}}")
                        
                            $("#calendar").fullCalendar
                            ({
                                header: 
                                {
                                    'left': 'prev,next today', 
                                    'center': 'title',
                                    'right': 'month, listMonth'
                                },
                                    events: appointment,
                                    // selectable: true,
                                    // selectHelper: true,
                                    select: function(start, end, allDays)
                                    {
                                        $('#appointmentModal').modal('toggle');
                                
                                        $('#saveBtn').click(function()
                                    {
                                        var app_date = $('#datepicker').val();
                                        var time_start = $('#time_start').val();
                                        var time_end = $('#time_end').val();
                                        var title = doctor;
                                        $.ajax
                                        ({
                                            url:"{{route('appointment.store')}}",
                                            type: "POST",
                                            dataType: 'json',
                                            data:{app_date, time_start, time_end},
                                           
                                            success:function(data)
                                            {
                                                $('#appointmentModal').modal('hide')
                                            
                                                $('#calendar').fullCalendar('renderEvent',
                                                {
                                                    'title': title,
                                                    'start': app_date,
                                                    'end': app_date,
                                                    'color': '#47ceff'
                                                });
                                                swal.fire
                                                ({
                                                    title: "Good job", 
                                                    text: "You created an Appointment!", 
                                                    type: "success"
                                                }).then(function(){ 
                                                    location.reload();
                                                });
                                            },
                                            error:function(error)
                                            {
                                                if(error.responseJSON.errors)
                                                {  
                                                    $('#error').html(error.responseJSON.errors),
                                                    $('#dateError').html(error.responseJSON.errors.app_date),
                                                    $('#startError').html(error.responseJSON.errors.time_start),
                                                    $('#endError').html(error.responseJSON.errors.time_end)
                                                    setTimeout(function(){// wait for 5 secs(2)
                                                    location.reload(); // then reload the page.(3)
                                                     }, 2000); 
                                                }
                                            },
                                        });
                                });
                            },
                            editable: true,

                            eventDrop: function(event)
                            {
                                var id = event.id;
                                var url ="{{route('appointment.updateTime', '')}}" +'/'+ id;
                                var app_date = moment(event.start).format('YYYY-MM-DD');
                                var time_start = moment(event.start).format('hh:mm');
                                var time_end = moment(event.end).format('hh:mm');
                                var doctorId = $('#doctor_id').val();
                                
                                $.ajax
                                ({
                                    url: url,
                                    type: "PATCH",
                                    dataType: 'json',
                                    data:{app_date, time_start, time_end, doctorId},
                                
                                    success:function(response)
                                    {
                                        swal.fire({
                                        title: "Good job!",
                                        text: "Appointment Updated",
                                        icon: "success",
                                        });
                                        // console.log(response)
                                    },
                                    error:function(error)
                                    {
                                        
                                        swal.fire({
                                        title: "Error!",
                                        text: error.responseJSON.message,
                                        icon: "error",
                                        }).then(function(){ 
                                            location.reload();
                                            });
                                    },
                                });
                            },
                            selectAllow: function(event)
                            {
                                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false),'day');
                            },
                            eventClick: function(event){
                                var id = event.id;
                            
                                const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                                })
                                    
                                swalWithBootstrapButtons.fire({
                                title: 'Are you sure to remove?? ',
                                text: moment(event.start).format('LL') + ' / ' + moment(event.start).format('h:mm A') + ' - ' + moment(event.end).format('h:mm A') ,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax
                                    ({
                                        url: "{{route('appointment.destroy', '')}}" +'/'+ id,
                                        type: "DELETE",
                                        dataType: 'json',
                                        success:function(response)
                                        {
                                            var id = response.id
                                            swalWithBootstrapButtons.fire(
                                            'Deleted!',
                                            'The Date ' + moment(event.start).format('LL') + ' Time '+ moment(event.start).format('h:mm A') + ' - ' + moment(event.end).format('h:mm A') + ' has been Deleted'  ,
                                            'success'
                                            ).then(function(){ 
                                            location.reload();
                                            });
                                            
                                        }
                                    });        
                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'The Appointment date and time deletion is cancelled',
                                    'error'
                                    )
                                }
                                })                        
                            }
                        })
                });      
            </script>
            <!-- end full calendar -->
                
            <script type="text/javascript">
                
                $(document).ready(function(){
                        $("#datepicker").datetimepicker({
                        format: 'YYYY-MM-DD',
                        minDate : moment(),
                        daysOfWeekHighlighted: "0",
                        daysOfWeekDisabled: [0]
                        })
                });

                $(document).ready(function(){
                        $("#datepickers2").datetimepicker({
                        format: 'YYYY-MM-DD',
                        minDate : moment(),
                        daysOfWeekHighlighted: "0",
                        daysOfWeekDisabled: [0]
                        })
                });
                
                
            </script>

            <!-- Time Picker -->
                <script>
                    $(document).ready(function()
                    {
                        $('#time_start').timepicker({
                            template: 'modal',
                            timeFormat : 'hh:mm a',
                            interval : 30,
                            minTime: '8',
                            startTime : '08:00',
                            maxTime : '5:00pm',    
                            dynamic : true,
                            dropdown : true,
                            scrollbar : true,
                            zindex: 9999999
                        });
                        
                        $('#time_end').timepicker({
                            template: 'modal',
                            timeFormat : 'hh:mm a',
                            interval : 30,
                            minTime: '8',
                            startTime : '08:00',
                            maxTime : '5:00pm',
                            dynamic : true,
                            dropdown : true,
                            scrollbar : true,
                            zindex: 9999999
                        });
                    });
                </script>
            <!-- END Time Picker -->

            <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>            
    </body>
</html>