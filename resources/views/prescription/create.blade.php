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


<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                    <h2>Findings</h2>
                    <input type="text" name="findings" class="form-control">
                </div>
        
                    <h2>Medicine</h2>
                <div class="form-group"> 
                    <table class="table table-clean" id="dynamicAddRemove">
                            <tr>
                                <th>Medicine Name</th>
                                <th>Medicine Grams</th>
                                <th>Medicine Intake</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="addmore[0]medicine_name" placeholder="Input Medicine" class="form-control"/></td>
                                <td><input type="text" name="addmore[0]medicine_gram" placeholder="Input Grams of Medicine" class="form-control"/></td>
                                <td><select name="addmore[0]medicine_intake" placeholder="Indicate Intake" class="form-control">
                                    <option value="OnceADayAfterMeal">Once a day / After Meal</option>
                                    <option value="TwiceADayAfterMeal">Twice a day / After Meal</option>
                                    <option value="ThriceADayAfterMeal">Thrice a day / After Meal</option>
                                    <option value="OnceADayBeforeMeal">Once a day / 30 mins Before Meal</option>
                                    <option value="TwiceADayBeforeMeal">Twice a day / 30 mins Before Meal</option>
                                    <option value="ThriceADayBeforeMeal">Thrice a day / 30 mins Before Meal</option>
                                </select></td>
                                <td><button type="button" name="add" id="add" class="btn btn-outline-primary">Add</button></td>
                            </tr>
                    </table>
                </div>
                <!-- <div class="form-group">
                    <label>Grams</label>
                    <input type="text" name="medicine_gram" class="form-control">
                </div> -->
                <!-- <div class="form-group">
                    <label>Medicine Intake</label>
                    <textarea name="medicine_intake" class="form-control" placeholder="Intake" required=""></textarea>
                </div> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
@endsection