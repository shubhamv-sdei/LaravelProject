<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trial_id')->nullable();
            // $table->unsignedBigInteger('trial_id')->index('role');
            // $table->foreign('trial_id')->references('id')->on('saved_trials');
            // $table->unsignedBigInteger('investigator_id')->index('role');
            // $table->foreign('investigator_id')->references('id')->on('users');

            $table->bigInteger('investigator_id')->nullable();
            $table->bigInteger('physican_id')->nullable();
            $table->string('patient_ids')->nullable();
            $table->bigInteger('assigned_by')->unsigned();
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->enum('inv_status',['1','2','3'])->default('1')->comment('pending, approved, cancelled');
            $table->enum('physican_status',['1','2','3'])->default('1')->comment('pending, approved, cancelled');
            $table->enum('patient_status',['1','2','3'])->default('1')->comment('pending, approved, cancelled');
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
        Schema::dropIfExists('assignments');
    }
}
