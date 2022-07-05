@extends('admin.layouts.master')

@section('content')
<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-medkit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Prescription</h5>
                            <span>Prescription</span>
                        </div>

                    </div>
                </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('doctor.index')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Prescription</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
            </div>
        </div>



    <div class="card">
    @foreach($bookings->user as $user)
        <div class="card-header"><h3>Prescription for {{$user->user_fName}} {{$user->user_lName}}</h3></div>
        @endforeach
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
                
            </div>           
        @endforeach
        <div class="card-body">
        <form Action="{{route('prescription.store')}}" method="post">@csrf
            <div class="form-group">
               
                    <h5>Diagnosis</h5>
                    <input type="text" name="pres_findings" class="form-control">
                </div>
              
        
                    <h5>Medicine</h5>
                <div class="form-group"> 
                    <table class="table table-striped" id="dynamicAddRemove">
                            <tr>
                                <th>Medicine Name</th>
                                <th>Frequency</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" autocomplete="off" id="medicine_name" name="medicine_name[]" placeholder="Input Medication" class="form-control" list="medicine"/></td>
                                <td><input type="text" autocomplete="off"name="medicine_frequency[]" placeholder="Indicate Frequency" class="form-control" list="frequency"></td>
                                <td><input type="text" autocomplete="off"name="medicine_duration[]" placeholder="Indicate Duration" class="form-control" list="duration"></td>
                                <td><button type="button" name="add" id="add" class="btn btn-outline-primary">Add</button></td>
                            </tr>
                    </table>
                </div>  

                 <!-- <td><input type="text" name="addmore[0][medicine_strength]" placeholder="Indicate Medicine Strength" class="form-control"></td>
                                <td><input type="text" name="addmore[0][medicine_amount]" placeholder="Indicate Amount EG.(1 TAB, 1 CAP)" class="form-control"></td>
                <td><input type="text" id="medicine_name" name="addmore[0][medicine_name]" placeholder="Input Medication" class="form-control"/></td>
                                <td id="medicine_syrup"><input type="text"  name="addmore[0][medicine_name]" placeholder="Input Medication" class="form-control" list="route"/></td>
                                <td id="medicine_tablet"><input type="text"  name="addmore[0][medicine_name]" placeholder="Input Medication" class="form-control" list="frequency"/></td>
                                <td id="medicine_capsule"><input type="text"  name="addmore[0][medicine_name]" placeholder="Input Medication" class="form-control" list="wewew"/></td> -->
                    <datalist id="wewew">
                        @foreach($bookings->user as $user)
                        <option value="{{$user->user_fName}}">{{$user->user_fName}}</option>
                        @endforeach
                    </datalist>
                    <datalist id="medicine" style="font-size: 20px;">
                        @foreach(App\Models\medicine::All() as $medicine)
                                    <option value="{{$medicine->medicine_name}}" >{{$medicine->medicine_name}}</option>
                        @endforeach
                    </datalist>
                   

                    <datalist id="frequency">
                            <option value="Once a Day(O.D)">Once a Day(O.D)</option>
                            <option value="Twice a Day(B.I.D)">Twice a Day(B.I.D)</option>
                            <option value="Thrice a Day(T.I.D)">Thrice a Day(T.I.D)</option>
                            <option value="4 times a Day(Q.I.D)">4 times a Day(Q.I.D)</option>
                            <option value="every 4 hours">every 4 hours</option>
                            <option value="every 6 hours">every 6 hours</option>
                            <option value="as needed">as needed</option>
                            
                    </datalist>

                    <datalist id="duration">
                            <option value="1 Day">1 Day</option>
                            <option value="2 Days">2 Days</option>
                            <option value="3 Days">3 Days</option>
                            <option value="4 Days">4 Days</option>
                            <option value="5 Days">5 Days</option>
                            <option value="6 Days">6 Days</option>
                            <option value="1 Week">1 Week</option>
                            <option value="2 Weeks">2 Weeks</option>
                            <option value="3 Weeks">3 Weeks</option>
                            <option value="1 Month">1 Month</option>
                            <option value="2 Months">2 Months</option>
                            <option value="3 Months">3 Months</option>
                            <option value="4 Months">4 Months</option>
                            <option value="5 Months">5 Months</option>
                            <option value="6 Months">6 Months</option>
                            <option value="Until symptoms gone">Until symptoms gone</option>
                            <option value="Maintenance">Maintenance</option>

                    </datalist>

                <!-- <div class="form-group">
                    <label>Grams</label>
                    <input type="text" name="medicine_gram" class="form-control">
                </div> -->
                <!-- <div class="form-group">
                    <label>Medicine Intake</label>
                    <textarea name="medicine_intake" class="form-control" placeholder="Intake" required=""></textarea>
                </div> -->
                <input type="text" name="user_id" value="{{$bookings->user_id}}">
                <input type="text" name="doctor_id" value="{{$bookings->doctor_id}}">
                <input type="text" name="app_date" value="{{$bookings->app_date}}">

                <a href="{{route('patients.today')}}"class="btn btn-secondary"style ="color: white;" >Cancel</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>

<style>
    .card{
        font-size: 15px;
    }
    input[type="text"]{
        font-size: 15px;
        
    }
</style>
@endsection