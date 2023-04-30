<div class="page-wrap">
<div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="{{url('dashboard/users')}}">
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
                                    <a href="{{url('dashboard/users')}}"><i class="ik ik-user-plus"></i><span>My Profile</span></a>
                                </div>
                                    <div class="nav-lavel">Appointment</div>
                                    <!-- <div class="nav-item">
                                        <a href="{{route('users.create')}}"><i class="ik ik-calendar"></i><span>Book an Appointment</span></a>
                                    </div> -->
                                    <div class="nav-item">
                                        <a href="{{route('calendar.index')}}"><i class="ik ik-calendar"></i><span>Book an Appointment</span></a>
                                    </div>
                                    <div class="nav-item">
                                        <a href="{{route('my.booking')}}"><i class="fa fa-book"></i><span>My Booking ({{App\Models\Booking::where('book_status', 0)->where('app_date','>=', date('Y-m-d'))->where('user_id', auth()->user()->id)->count()}}) </span></a>
                                    </div>
                                    <div class="nav-item">
                                        <a href="{{route('myPrescription')}}"><i class="ik ik-clipboard"></i><span>My History</span></a>
                                    </div>
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