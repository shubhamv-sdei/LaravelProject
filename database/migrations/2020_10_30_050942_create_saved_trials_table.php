<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_trials', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('rank')->nullable();
            $table->string('NCTId')->nullable();
            $table->string('Condition')->nullable();
            $table->longText('BriefTitle')->nullable();
            $table->longText('OfficialTitle')->nullable();
            $table->longText('BriefSummary')->nullable();
            $table->string('OverallStatus')->nullable();
            $table->string('InterventionName')->nullable();
            $table->string('LocationFacility')->nullable();
            $table->string('LocationCity')->nullable();
            $table->string('LocationState')->nullable();
            $table->string('LocationCountry')->nullable();
            $table->longText('EligibilityCriteria')->nullable();
            $table->string('MinimumAge')->nullable();
            $table->string('MaximumAge')->nullable();
            $table->string('Gender')->nullable();
            $table->string('HealthyVolunteers')->nullable();
            $table->enum('status',['1','2','3'])->default('1')->comment('pending, approved, cancelled');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('saved_trials');
    }
}
