<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->String('pres_findings');
            $table->integer('user_id');
            $table->integer('doctor_id');
            $table->String('app_date');
            $table->String('medicine_name');   
            $table->String('medicine_gram');   
            $table->String('medicine_intake');   
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
        Schema::dropIfExists('prescriptions');
    }
}
