<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPatientReimbursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_patient_reimburs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->integer('trial_id')->nullable();
            $table->date('patient_ref_date')->nullable();
            $table->date('chart_rev_date')->nullable();
            $table->date('el_ass_date')->nullable();
            $table->string('patient_contact')->nullable();
            $table->longText('clinic_name')->nullable();
            $table->longText('ins_address')->nullable();
            $table->longText('tax_id')->nullable();
            $table->longText('bank_name')->nullable();
            $table->longText('routing')->nullable();
            $table->longText('account_no')->nullable();
            $table->integer('payment_log_id')->nullable();
            $table->longText('country')->nullable();
            $table->longText('currency')->nullable();
            $table->longText('account_holder_name')->nullable();
            $table->longText('account_holder_type')->nullable();

            $table->longText('stripe_account_key')->nullable();
            $table->longText('stripe_account_json_res')->nullable();

            $table->enum('status',['1','2'])->default('1')->comment('Active, InActive');
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
        Schema::dropIfExists('model_patient_reimburs');
    }
}
