<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->date('date');
            $table->time('time');
            $table->enum('appointment_type',['1','2'])->default('1')->comment('Video,Chat');
            $table->bigInteger('from')->unsigned();
            $table->foreign('from')->references('id')->on('users');
            $table->bigInteger('to')->unsigned();
            $table->foreign('to')->references('id')->on('users');
             $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->enum('status',['1','2'])->default('1')->comment('pending, approved');
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
        Schema::dropIfExists('appointments');
    }
}
