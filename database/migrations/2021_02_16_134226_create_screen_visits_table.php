<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_visits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('trial_id')->nullable();
            // $table->foreign('trial_id')->references('id')->on('saved_trials');

            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users');

            $table->bigInteger('invistigator_id')->unsigned();
            $table->foreign('invistigator_id')->references('id')->on('users');

            $table->timestamp('screen_visit_schedule_date')->nullable();
            $table->enum('screen_visit_complete',['1','2'])->default('1')->comment('Yes, No');
            $table->string('reason')->nullable();
            $table->timestamp('screen_visit_complete_date')->nullable();

            $table->enum('status',['1','2'])->default('1')->comment('Active,InActive');
            $table->enum('type',['1','2'])->default('1')->comment('Patient,Inv');
            
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
        Schema::dropIfExists('screen_visits');
    }
}
