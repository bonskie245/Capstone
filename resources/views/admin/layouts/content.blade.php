
    <div class="container-fluid">
    
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Patients</h6>
                                <h2>{{App\Models\User::where('role_id',4)->count()}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-users"></i>
                            </div>
                        </div>
                        
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"  style="width: 100%;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Doctors</h6>
                                <h2>{{App\Models\User::where('role_id',2)->count()}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-user-plus"></i>
                            </div>
                        </div>
                        
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"  style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Receptionist</h6>
                                <h2>{{App\Models\User::where('role_id',3)->count()}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-user-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"  style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Bookings</h6>
                                <h2>{{App\Models\Booking::count()}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-message-square"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Pending bookings</h6>
                                @if(isset($doctor_id))
                                <h2>{{App\Models\Booking::where('doctor_id', $doctor_id->id)->where('app_date', '>=',date('Y-m-d'))->where('book_status', 0)->count()}}</h2>
                                @else
                                <h2>{{App\Models\Booking::where('app_date', '>=',date('Y-m-d'))->where('book_status', 0)->count()}}</h2>
                                @endif

                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Confirmed Bookings</h6>
                                @if(isset($doctor_id))
                                <h2>{{App\Models\Booking::where('doctor_id', $doctor_id->id)->where('app_date', '>=',date('Y-m-d'))->where('book_status', 1)->count()}}</h2>
                                @else
                                <h2>{{App\Models\Booking::where('app_date', '>=',date('Y-m-d'))->where('book_status', 1)->count()}}</h2>
                                @endif
                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Declined Bookings</h6>
                                @if(isset($doctor_id))
                                <h2>{{App\Models\Booking::where('doctor_id', $doctor_id->id)->where('app_date', '>=',date('Y-m-d'))->where('book_status', 4)->count()}}</h2>
                                @else
                                <h2>{{App\Models\Booking::where('app_date', '>=',date('Y-m-d'))->where('book_status', 4)->count()}}</h2>
                                @endif
                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Cancelled Bookings</h6>
                                @if(isset($doctor_id))
                                <h2>{{App\Models\Booking::where('doctor_id', $doctor_id->id)->where('app_date', '>=',date('Y-m-d'))->where('book_status', 5)->count()}}</h2>
                                @else
                                <h2>{{App\Models\Booking::where('app_date', '>=',date('Y-m-d'))->where('book_status', 5)->count()}}</h2>
                                @endif
                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6" >
                <div class="card" >
                    <div class="card-header">
                        <h3>Registered Users</h3>
                    </div>
                    <div class="card-block text-center">
                        <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="25%">
                        </canvas></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-6" >
                <div class="card" >
                    <div class="card-header">
                        <h3>Total Bookings</h3>
                    </div>
                    <div class="card-block text-center">
                        <div class="card-body">
                        <canvas id="myBarChart2" width="100%" height="25%">
                        </canvas></div>
                    </div>
                </div>
            </div>
            
            <!-- <div style="height:400px; width:100%; margin:auto;">
                    <div class="card">
                        <div class ="card-body">
                            
                        </div>
                    </div>
            </div> -->
                <div style="height:400px; width:500px; margin:auto;">
                    <canvas id="barChart">
                    </canvas>
                </div>
        <script>
        
            var _ydata= JSON.parse('{!! json_encode($months) !!}');
            var _xdata= JSON.parse('{!! json_encode($monthCount) !!}');
            
            
            var _yBooking= JSON.parse('{!! json_encode($bookMonths) !!}');
            var _xBooking= JSON.parse('{!! json_encode($bookingCount) !!}');
         

        </script>
    </div>
   
                        
                      
                    
                      