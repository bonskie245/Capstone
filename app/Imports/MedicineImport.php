<?php

namespace App\Imports;

use App\Models\medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicineImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = new Medicine([
            "medicine_name" =>$row['medicine_name'],
            "medicine_dosage" => $row['medicine_dosage'],
            "medicine_type" => $row['medicine_type']
        ]);

       return $data;
    }
}
