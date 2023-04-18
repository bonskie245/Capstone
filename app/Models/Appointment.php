<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function doctor(){ 
        return $this->belongsTo(Doctor::class,'doctor_id','id');

    }

    
}
