<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->bigInteger('clinical_id')->unsigned();
            //$table->foreign('clinical_id')->references('id')->on('saved_trials');
            $table->bigInteger('research_site_id')->nullable();
            $table->string('visit_name')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->enum('status',['1','2'])->default('1')->comment('Active, InActive');
            $table->longText('case_notes')->nullable();
            $table->bigInteger('charge_status')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('trial_visits');
    }
}
