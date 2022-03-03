@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <table class="table table-clean" id="dynamicAddRemove">
                        <td><input type="text" name="medicine_name[0]" placeholder="Input Medicine" class="form-control" />
                        </td>
                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add</button></td>
                        </table>
                    </div>

                <div id="app">
  
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
