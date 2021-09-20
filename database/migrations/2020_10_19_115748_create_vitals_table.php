<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('BP')->nullable();
            $table->longText('HR')->nullable();
            $table->longText('RR')->nullable();
            $table->longText('temp')->nullable();
            $table->longText('pain')->nullable();
            $table->longText('height')->nullable();
            $table->longText('weight')->nullable();
            $table->longText('BMI')->nullable();
            $table->longText('SPO2')->nullable();
            $table->bigInteger('added_by')->unsigned();
            $table->foreign('added_by')->references('id')->on('users');
            $table->enum('status',['1','2'])->default('1')->comment('Active, Deactive');
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
        Schema::dropIfExists('vitals');
    }
}
