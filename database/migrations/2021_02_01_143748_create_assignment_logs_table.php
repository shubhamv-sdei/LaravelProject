<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trial_id')->nullable();
            //$table->foreign('trial_id')->references('id')->on('saved_trials');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('assigned_from')->unsigned();
            $table->foreign('assigned_from')->references('id')->on('users');
            $table->bigInteger('assigned_to')->unsigned();
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->string('remark')->nullable();
            $table->enum('type',['1','2'])->default('1')->comment('assign, unassign');
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
        Schema::dropIfExists('assignment_logs');
    }
}
