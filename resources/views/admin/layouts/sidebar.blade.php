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
                                <div class="nav-lavel">Navigation</div>
                                <div class="nav-item">
                                    <a href="{{url('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>
                              <!--   <div class="nav-item">
                                    <a href="pages/navbar.html"><i class="ik ik-menu"></i><span>Navigation</span> <span class="badge badge-success">New</span></a>
                                </div> -->


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

                                @elseif(auth()->check()&&auth()->user()->role->name ==='doctor')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>Appointment Management</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('appointment.index')}}" class="menu-item">View Appointment</a>
                                        <a href="{{route('appointment.create')}}" class="menu-item">Create Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                </div>
                            
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-calendar"></i><span>Patient Appointment</span></a>
                                    <div class="submenu-content">
                                        <a href="{{route('patient')}}" class="menu-item">View Appointment Today</a>
                                        <a href="{{route('all.appointments')}}" class="menu-item">All Appointment</a>
                                        <!-- <a href="pages/widget-data.html" class="menu-item">Data</a>
                                        <a href="pages/widget-chart.html" class="menu-item">Chart Widget</a> -->
                                    </div>
                                
                                    @endif
                                <div class="nav-item">
                                    <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
                                                     href="{{ route('logout') }}"><i class="ik ik-power dropdown-icon">
                                                     </i><span>Logout</span></a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>  



                            </nav>
                        </div>
                    </div>
                </div>