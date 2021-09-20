<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicalTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_trials', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('form_type')->nullable();
            $table->integer('status')->nullable();
            $table->integer('enroll_status')->nullable();
            $table->string('study_title')->nullable();
            $table->string('private_name')->nullable();
            $table->string('site_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('email')->nullable();
            $table->string('no_of_visits')->nullable();
            $table->string('vol_condition')->nullable();
            $table->string('medical_condition')->nullable();
            $table->longText('rationale')->nullable();
            $table->boolean('sub_accept')->nullable();
            $table->string('drug_class')->nullable();
            $table->string('reg_phy')->nullable();
            $table->string('mechanism')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('phase')->nullable();
            $table->longText('inc_criteria')->nullable();
            $table->longText('exc_criteria')->nullable();
            $table->longText('summary_exc_inc')->nullable();
            $table->longText('participation')->nullable();
            $table->boolean('placebo')->nullable();
            $table->string('form_irb')->nullable();
            $table->string('recent_icf')->nullable();
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
        Schema::dropIfExists('clinical_trials');
    }
}
