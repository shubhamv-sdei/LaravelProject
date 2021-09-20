<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('to')->unsigned();
            $table->foreign('to')->references('id')->on('users');
            $table->bigInteger('from')->unsigned();
            $table->foreign('from')->references('id')->on('users');
            $table->string('message')->nullable();
            $table->string('redirect')->nullable();
            $table->enum('type',['1','2','3','4','5','6'])->default('1')->comment('default, trial_assignment,patientapplytrial,physicanrefferal,chat,assignPatient,patientreportupdate');
            $table->enum('status',['1','2'])->default('1')->comment('unread, read');
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
        Schema::dropIfExists('notifications');
    }
}
