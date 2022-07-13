
                    
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
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
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
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
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
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
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
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
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
                        
                      
                    
                      