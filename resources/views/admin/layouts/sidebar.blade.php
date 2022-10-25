 <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="{{url('dashboard/admin')}}">
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
                                    <a href="{{url('dashboard/admin')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>


                                 @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                 <div class="nav-lavel">CRUD Management</div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Doctor/Receptionist</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('doctor.index')}}" class="menu-item">View Doctor</a>
                                        <a href="{{route('receptionist.index')}}" class="menu-item">View Secretary</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif
                                <!-- @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                <div class="nav-lavel">SECRETARY CRUD</div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"> <i class="ik ik-user"></i><span>Secretary Management</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('receptionist.index')}}" class="menu-item">View Secretary </a>
                                        <a href="{{route('receptionist.create')}}" class="menu-item">Create Secretary</a>
                                    </div>
                                </div> 
                                @endif -->
                              
                                <!-- @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="fas fa-hospital"></i><span>Department</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('department.index')}}" class="menu-item">View Department</a>
                                        <a href="{{route('department.create')}}" class="menu-item">Create Department</a>
                                    </div>
                                </div>
                                @endif -->

                                @if(auth()->check()&&auth()->user()->role->name ==='admin')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="fa fa-heartbeat"></i><span>Medicine</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('medicine.index')}}" class="menu-item">View Medicine Data</a>
                                        <a href="{{route('medicine.create')}}" class="menu-item">Create Medicine Data</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif

                                @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                <div class="nav-lavel">Create Appointment</div>
                                <div class="nav-item">
                                    <a href="{{route('appointment.index')}}"><i class="ik ik-calendar"></i><span>Appointment Management</span></a>
                                    <!-- <div class="submenu-content">
                                        <a href="{{route('appointment.index')}}" class="menu-item">View Appointment</a> -->
                                        <!-- <a href="{{route('appointment.create')}}" class="menu-item">Create Appointment</a> -->
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    <!-- </div> -->
                                </div>
                                @endif

                                @if(auth()->check()&&auth()->user()->role->name ==='patient')
                                <div class="nav-lavel">All Appointment</div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>Patients Appointment</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('patient')}}" class="menu-item">View Booking Calendar</a>
                                        <a href="{{route('patient.today')}}" class="menu-item">View Appointment Today</a>
                                        <a href="{{route('all.appointments')}}" class="menu-item">All Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                @endif

                                @if(auth()->check()&&auth()->user()->role->name ==='receptionist')
                                <div class="nav-lavel">All Appointment</div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>Patients Appointment</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('patient')}}" class="menu-item">View Booking Calendar</a>
                                        <a href="{{route('patient.today')}}" class="menu-item">View Appointment Today</a>
                                        <a href="{{route('all.appointments')}}" class="menu-item">All Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                                    @endif
                                  
                                    @if(auth()->check()&&auth()->user()->role->name ==='doctor')
                                    <div class="nav-item has-sub">
                                        <a href="javascript:void(0)"><i class="ik ik-user"></i><span>Patient Appointment Management</span></a>
                                        <div class="submenu-content">
                                            <a href="{{route('patients.today')}}" class="menu-item">My Online-Patient Today</a>
                                            <a href="{{route('walkin.index')}}" class="menu-item">My Walkin-Patient Today</a>
                                            <a href="{{route('prescribed.patients')}}" class="menu-item">Patient Medical history</a>
                                            <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                            <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                        </div>
                                    </div>
                                    @endif

                                    @if(auth()->check()&&auth()->user()->role->name ==='receptionist')
                                    <div class="nav-lavel">Patients</div>
                                    <div class="nav-item has-sub">
                                        <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Patient Management</span></a>
                                        <div class="submenu-content">
                                            <a href="{{route('patient.index')}}" class="menu-item"></i><span> Patient Management</span></a>
                                            <a href="{{route('prescribed.patients')}}" class="menu-item">Patient Medical history</a>
                                            <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                            <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <br>

                                   
                                    <div class="nav-item" style="position: absolute; width: 50%; bottom: 10px;">
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