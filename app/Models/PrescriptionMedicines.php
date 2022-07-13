<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;
use App\Models\User;
use App\Models\medicine;

class PrescriptionMedicines extends Model
{
    
    use HasFactory;

    protected $guarded =[];
    public function prescription(){
        return $this->has(Prescription::class,'prescription_id', 'id');
    }
}
