<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor;

class WalkIn extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
