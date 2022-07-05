<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class Booking extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function doctor()
    {
        return $this->hasOne(Doctor::class,'id','doctor_id');
    }

    public function user()
    {
        return $this->hasMany(User::class,'id', 'user_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class,'id','app_id');
    }
}
