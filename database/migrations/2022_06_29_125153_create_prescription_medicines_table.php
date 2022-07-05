<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id');
            $table->string('medicine_name')->nullable();
            // $table->string('medicine_strength')->nullable();
            $table->string('medicine_amount')->nullable();
            $table->string('medicine_duration')->nullable();
            $table->string('medicine_frequency')->nullable();
            // $table->string('medicine_dispensing')->nullable();
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
        Schema::dropIfExists('prescription_medicines');
    }
}
