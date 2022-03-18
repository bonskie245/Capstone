 <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index.html">
                            <span class="text">Urgent Care Clinic</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">
                            <nav id="main-menu-navigation" class="navigation-main">
                                <div class="nav-lavel">Role: {{auth()->user()->role->name}}</div>
                                <div class="nav-item">
                                    <a href="{{url('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>


                                 @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Doctor Management</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('doctor.index')}}" class="menu-item">View Doctor</a>
                                        <a href="{{route('doctor.create')}}" class="menu-item">Create Doctor</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif
                                @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="fas fa-hospital"></i><span>Department</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('department.index')}}" class="menu-item">View Department</a>
                                        <a href="{{route('department.create')}}" class="menu-item">Create Department</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif
                                @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>Appointment Management</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('appointment.index')}}" class="menu-item">View Appointment</a>
                                        <a href="{{route('appointment.create')}}" class="menu-item">Create Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif

                                @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>All Patient Appointment</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('patient')}}" class="menu-item">View Appointment Today</a>
                                        <a href="{{route('all.appointments')}}" class="menu-item">All Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                
                                    @endif
                                
                                    @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                    <div class="nav-item has-sub">
                                        <a href="javascript:void(0)"><i class="ik ik-user"></i><span>Patient Appointments</span></a>
                                        <div class="submenu-content">
                                            <a href="{{route('patients.today')}}" class="menu-item">My Patient Today</a>
                                            <a href="{{route('prescribed.patients')}}" class="menu-item">All Prescribed Patient</a>
                                            <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                            <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                        </div>
                                    </div>

                                    @endif
                                    @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                    <div class="nav-item has-sub">
                                        <a href="javascript:void(0)"><i class="ik ik-user"></i><span>Patient Management</span></a>
                                        <div class="submenu-content">
                                            <a href="{{route('patient.index')}}" class="menu-item">View Patient</a>
                                            <a href="{{route('patient.create')}}" class="menu-item">Create Patient</a>
                                            <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                            <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                        </div>
                                    </div>

                                    @endif
                               
                                

                                    <div class="nav-item">
                                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                                     href="{{ route('logout') }}"><i class="ik ik-power"></i><span>Log Out</span></a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </div> 


                            </nav>
                        </div>
                    </div>
                </div>