<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicalManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_manages', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('clinical_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('lab_results')->nullable();
            $table->string('lab_date')->nullable();
            $table->string('medications')->nullable();
            $table->longtext('inc_criteria')->nullable();
            $table->longtext('exc_criteria')->nullable();
            $table->string('placebo')->nullable();
            $table->integer('charge_status')->nullable();
            $table->string('image_name')->nullable();

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
        Schema::dropIfExists('clinical_manages');
    }
}
