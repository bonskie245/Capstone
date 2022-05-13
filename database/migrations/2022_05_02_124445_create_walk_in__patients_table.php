<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalkInPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walk_in__patients', function (Blueprint $table) {
            $table->id();
            $table->String('patient_fName');
            $table->String('patient_lName');
            $table->String('patient_gender');
            $table->String('patient_address');
            $table->String('patient_phoneNum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('walk_in_patients');
    }
}
