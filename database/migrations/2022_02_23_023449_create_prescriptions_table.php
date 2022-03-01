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
         Schema::create('precriptions', function (Blueprint $table) {
            $table->id();
            $table->String('findings');
            $table->integer('user_id');
            $table->integer('doctor_id');
            $table->String('date');
            $table->String('medicine_name');   
            $table->String('medicine_gram');   
            $table->Text('medicine_intake');   
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
