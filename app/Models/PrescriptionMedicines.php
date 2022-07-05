<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;
use App\Models\User;
use App\Models\medicine;

class PrescriptionMedicines extends Model
{
    protected $guarded =[];
    use HasFactory;

    public function prescription(){
        return $this->belongsTo(Prescription::class,'prescription_id', 'id');
    }
}
